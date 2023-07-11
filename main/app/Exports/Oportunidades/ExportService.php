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
        return Formulario::join('users as propietario', 'propietario.id', 'formularios.propietario_id')
            ->selectRaw("propietario.name as creador, 
            formularios.identificacion,
            Concat_ws(' ', formularios.nombre,  formularios.apellido) as 'nombre completo',
            formularios.email,
            formularios.telefono,
            formularios.direccion,
            formularios.puesto_votacion,
            formularios.created_at
            ")
            ->where('formularios.estado', false)
            ->get();
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
            'Creador',
            'Identificación',
            'Nombre completo',
            'Email',
            'Telefono',
            'Dirección',
            'Puesto de votacion',
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
