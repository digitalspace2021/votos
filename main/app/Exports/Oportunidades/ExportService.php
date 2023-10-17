<?php

namespace App\Exports\Oportunidades;

use App\Models\Formulario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportService implements FromCollection, WithHeadings, ShouldQueue, ShouldAutoSize
{
    protected $req;

    public function __construct($req)
    {
        $this->req = $req;
    }

    /**
     * The function returns a collection of form data joined with user data where the form state is
     * false.
     * 
     * @return Collection a collection of formularios (forms) that meet the specified conditions. The
     * collection includes the following fields: creador (creator), identificacion (identification),
     * nombre completo (full name), email, telefono (phone number), direccion (address), and
     * puesto_votacion (voting station). The forms returned have a estado (status) of false.
     */
    public function collection(): Collection
    {
        $forms = Formulario::join('users as propietario', 'propietario.id', 'formularios.propietario_id')
            ->selectRaw("propietario.name as creador, 
            formularios.identificacion,
            Concat_ws(' ', formularios.nombre,  formularios.apellido) as 'nombre completo',
            formularios.email,
            formularios.telefono,
            formularios.direccion,
            Concat_ws(' - ', formularios.tipo_zona, formularios.zona) as ubicacion,
            formularios.puesto_votacion,
            formularios.tipo_zona,
            formularios.zona,
            formularios.mesa,
            formularios.created_at,
            formularios.id
            ")
            ->when($this->req->puesto, function ($query, $puesto) {
                if (is_numeric($puesto)) {
                    return $query->where('formularios.puesto_votacion', $puesto);
                } else {
                    return $query->whereRaw('NOT formularios.puesto_votacion REGEXP "^[0-9]+$"');
                }
            })
            ->where('formularios.estado', false)
            ->get();

        foreach ($forms as $form) {
            $candidatos = $form->candidatos->pluck('name')->toArray();
            $form->ubicacion = $form->ubicacion();
            $form->puesto_votacion = is_numeric($form->puesto_votacion) ? $form->puestoVotacion->name : $form->puesto_votacion;
            $form->candidatos = implode(', ', $candidatos);
            $form->fecha_creacion = $form->created_at;

            unset($form->zona);
            unset($form->tipo_zona);
            unset($form->id);
            unset($form->created_at);
        }
        return $forms;
    }

    /**
     * The function headings() returns an array of headings for a table.
     * 
     * @return array An array of headings is being returned. The headings include 'Creador',
     * 'Identificación', 'Nombre completo', 'Email', 'Telefono', 'Dirección', 'Puesto de votacion', and
     * 'Fecha actualizacion'.
     */
    public function headings(): array
    {
        return [
            'Responsable',
            'Identificación',
            'Nombre completo',
            'Email',
            'Telefono',
            'Dirección',
            'Ubicacion',
            'Puesto de votacion',
            'Mesa',
            'Candidatos',
            'Fecha creación',
        ];
    }

    /**
     * The function "registerEvents" sets the font size of all headers in a spreadsheet to 12.
     * 
     * @return array An array of events is being returned.
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:EZ1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }
}
