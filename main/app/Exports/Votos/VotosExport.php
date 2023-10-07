<?php

namespace App\Exports\Votos;

use App\Models\Formulario;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\ShouldQueueWithoutChain;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class VotosExport implements FromCollection, WithHeadings, ShouldQueueWithoutChain, ShouldAutoSize
{
    protected $query;

    /**
     * VotosExport constructor.
     *
     * @param Collection $query The collection of votes to be exported.
     */
    public function __construct(
        Collection $query
    ) {
        $this->query = $query;
    }

    /**
     * Get the collection of data to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $votos = $this->query;

        $votos->transform(function ($voto) {
            $form = Formulario::find($voto->id);
            $candidatos = $form->candidatos->pluck('name')->implode(', ');

            return [
                'creador' => $form->creador->name,
                'identificacion' => $form->identificacion,
                'nombre_completo' => $form->nombre . ' ' . $form->apellido,
                'voto' => $voto->voto->voto ? 'Si' : 'No',
                'ubicacion' => $form->ubicacion(),
                'direccion' => $form->direccion,
                'candidatos' => $candidatos,
                'fecha_creacion' => $form->created_at,
            ];
        });

        return $votos;
    }


    /**
     * Returns an array with the headings for the VotosExport class.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Creador',
            'Identificación',
            'Nombre completo',
            'Voto',
            'Ubicacion',
            'Dirección',
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
