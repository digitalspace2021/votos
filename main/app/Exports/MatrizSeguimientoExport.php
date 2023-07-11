<?php

namespace App\Exports;

use App\Models\MatrizSeguimiento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class MatrizSeguimientoExport implements FromCollection, WithHeadings, ShouldQueue, ShouldAutoSize
{
    private $candidato;
    private $pregunta;
    private $cedula;
    private $barrio;
    private $corregimiento;

    public function __construct($candidato,$pregunta,$cedula,$barrio,$corregimiento)
    {
        $this->candidato=$candidato;
        $this->pregunta=$pregunta;
        $this->cedula=$cedula;
        $this->barrio=$barrio;
        $this->corregimiento=$corregimiento;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $seguimientos = MatrizSeguimiento::join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
        ->join('users', 'formularios.propietario_id', '=', 'users.id')
        ->join('candidatos', 'formularios.candidato_id', '=', 'candidatos.id');

        if (!empty($this->candidato)) {
            $seguimientos->where('formularios.candidato_id', $this->candidato);
        }

        if (!empty($this->pregunta)) {
            if ($this->pregunta == 1) {
                $seguimientos->where('matriz_seguimiento.respuesta_uno', 1);
            }
            // Resto de condiciones if
        }

        if (!empty($this->cedula)) {
            $seguimientos->where('formularios.identificacion', $this->cedula);
        }

        if (!empty($this->barrio)) {
            $seguimientos->where('formularios.tipo_zona', 'comuna')
                ->where('formularios.zona', $this->barrio);
        }

        if (!empty($this->corregimiento)) {
            $seguimientos->where('formularios.tipo_zona', 'corregimiento')
                ->where('formularios.zona', $this->corregimiento);
        }

        $seguimientos->select(
            'formularios.identificacion as identificacion',
            'formularios.nombre as nombre',
            'users.name as creador',
            'candidatos.name as candidato',
            'formularios.email as email',
            'formularios.direccion as direccion',
            'formularios.telefono as telefono',
            DB::raw("CASE matriz_seguimiento.respuesta_uno WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_uno"),
            DB::raw("CASE matriz_seguimiento.respuesta_dos WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_dos"),
            DB::raw("CASE matriz_seguimiento.respuesta_tres WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_tres"),
            DB::raw("CASE matriz_seguimiento.respuesta_cuatro WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_cuatro"),
            DB::raw("CASE matriz_seguimiento.respuesta_cinco WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_cinco"),
            DB::raw("CASE matriz_seguimiento.respuesta_seis WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_seis")
        );

        return $seguimientos->get();

    }


    public function headings(): array
    {
        return [
            'Identificación',
            'Nombre completo',
            'Creador',
            'Candidato',
            'Email',
            'Dirección',
            'Telefono',
            'Se le enseño a votar?',
            'Se le pego publicidad?',
            'Tiene carro o moto para ir a votar?',
            'Se le ha echo seguimiento Constante?',
            'Se le ha visitado?',
            'El lugar de votacion es cerca a su casa?'
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