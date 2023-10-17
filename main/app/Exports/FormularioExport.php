<?php

namespace App\Exports;

use App\Models\Formulario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class FormularioExport implements FromCollection, WithHeadings, ShouldQueue, ShouldAutoSize
{
    protected $req;

    public function __construct($req)
    {
        $this->req = $req;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
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
            ->when($this->req->comuna, function ($query, $comuna) {
                return $query->where('formularios.tipo_zona', 'comuna')
                    ->where('barrios.comuna_id', $comuna);
            })
            ->when($this->req->corregimiento, function ($query, $corregimiento) {
                return $query->where('formularios.tipo_zona', 'corregimiento')
                    ->where('veredas.corregimiento_id', $corregimiento);
            })
            ->where('formularios.estado', true)
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
