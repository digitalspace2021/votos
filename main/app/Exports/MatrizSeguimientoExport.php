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
    private $comuna;
    private $barrio;
    private $corregimiento;

    public function __construct($candidato,$pregunta,$cedula,$comuna,$barrio,$corregimiento)
    {
        $this->candidato=$candidato;
        $this->pregunta=$pregunta;
        $this->cedula=$cedula;
        $this->comuna=$comuna;
        $this->barrio=$barrio;
        $this->corregimiento=$corregimiento;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $seguimientos = MatrizSeguimiento::join('formularios', 'matriz_seguimiento.formulario_id', '=', 'formularios.id')
        ->join('barrios', 'formularios.zona', '=', 'barrios.id')->join('comunas','barrios.comuna_id','=','comunas.id')
        ->join('users', 'formularios.propietario_id', '=', 'users.id')
        ->join('candidatos', 'formularios.candidato_id', '=', 'candidatos.id');

        if (!empty($this->candidato)) {
            $seguimientos->where('formularios.candidato_id', $this->candidato);
        }

        if (!empty($this->pregunta)) {
            if ($this->pregunta == 1) {
                $seguimientos->where('matriz_seguimiento.respuesta_uno', 1);
            }
            if ($this->pregunta == 2) {
                $seguimientos->where('matriz_seguimiento.respuesta_dos', 1);
            }
            if ($this->pregunta == 3) {
                $seguimientos->where('matriz_seguimiento.respuesta_tres', 1);
            }
            if ($this->pregunta == 4) {
                $seguimientos->where('matriz_seguimiento.respuesta_cuatro', 1);
            }
            if ($this->pregunta == 5) {
                $seguimientos->where('matriz_seguimiento.respuesta_cinco', 1);
            }
            if ($this->pregunta == 6) {
                $seguimientos->where('matriz_seguimiento.respuesta_seis', 1);
            }
            if ($this->pregunta == 7) {
                $seguimientos->where('matriz_seguimiento.respuesta_siete', 1);
            }
        }

        if (!empty($this->cedula)) {
            $seguimientos->where('formularios.identificacion', $this->cedula);
        }

        if(!empty($this->comuna)){
            $seguimientos->where('formularios.tipo_zona','comuna')
                        ->where('barrios.comuna_id',$this->comuna);
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
            DB::raw("CASE matriz_seguimiento.respuesta_seis WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_seis"),
            DB::raw("CASE matriz_seguimiento.respuesta_siete WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_siete"),
            DB::raw("CASE matriz_seguimiento.respuesta_ocho WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_ocho"),
            DB::raw("CASE matriz_seguimiento.respuesta_nueve WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_nueve"),
            DB::raw("CASE matriz_seguimiento.respuesta_diez WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_diez")
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
            'El dia de las elecciones tiene trasporte?',
            'Se le ha echo seguimiento Constante?',
            'Se le ha visitado?',
            'El lugar de votacion es cerca a su casa?',
            'Ha participado en actividades de forma frecuente?',
            'Se sabe el numero del candidato?',
            'Realizo reuniones con familiares o amigos?',
            'Mensaje de texto el dia de elecciones?'
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