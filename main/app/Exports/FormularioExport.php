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
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return Formulario::join('users as propietario', 'propietario.id', 'formularios.propietario_id')
            ->selectRaw("propietario.name as creador, 
            formularios.identificacion,
            Concat_ws(' ', formularios.nombre,  formularios.apellido) as 'nombre completo',
            formularios.email,
            formularios.telefono,
            formularios.direccion,
            formularios.puesto_votacion
            ")->get();
    }


    public function headings(): array
    {
        return [
            'Creador',
            'Identificación',
            'Nombre completo',
            'Email',
            'Telefono',
            'Dirección',
            'Puesto de votacion',
            'Fecha actualizacion',
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
