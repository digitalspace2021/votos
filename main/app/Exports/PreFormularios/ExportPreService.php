<?php
namespace App\Exports\PreFormularios;

use App\Models\Formulario;
use App\Models\PreFormulario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportPreService implements FromCollection, WithHeadings, ShouldQueue, ShouldAutoSize
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
        $pre_forms = PreFormulario::join('users as propietario', 'propietario.id', 'pre_formularios.propietario_id')
            ->selectRaw("propietario.name as creador, 
            pre_formularios.identificacion,
            Concat_ws(' ', pre_formularios.nombre,  pre_formularios.apellido) as 'nombre completo',
            pre_formularios.email,
            pre_formularios.telefono,
            pre_formularios.direccion,
            Concat_ws(' - ', pre_formularios.tipo_zona, pre_formularios.zona) as ubicacion,
            pre_formularios.puesto_votacion,
            pre_formularios.tipo_zona,
            pre_formularios.zona,
            pre_formularios.mesa,
            pre_formularios.created_at,
            pre_formularios.id
            ")
            ->when($this->req->puesto, function ($query, $puesto) {
                if (is_numeric($puesto)) {
                    return $query->where('pre_formularios.puesto_votacion', $puesto);
                } else {
                    return $query->whereRaw('NOT pre_formularios.puesto_votacion REGEXP "^[0-9]+$"');
                }
            })
            ->when($this->req->comuna, function ($query, $comuna) {
                return $query->where('pre_formularios.tipo_zona', 'comuna')
                    ->where('barrios.comuna_id', $comuna);
            })
            ->when($this->req->corregimiento, function ($query, $corregimiento) {
                return $query->where('pre_formularios.tipo_zona', 'corregimiento')
                    ->where('veredas.corregimiento_id', $corregimiento);
            })
            ->get();

        foreach ($pre_forms as $form) {
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
        return $pre_forms;
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
