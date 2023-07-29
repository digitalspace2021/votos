<?php

namespace App\Exports;

use App\Models\MatrizSeguimiento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class AlertaExport implements FromCollection, WithHeadings, ShouldQueue, ShouldAutoSize
{
   
    private $cedula;
    private $nombre;
    private $color;
    
    public function __construct($cedula,$nombre,$color)
    {
        $this->cedula=$cedula;
        $this->nombre=$nombre;
        $this->color=$color;
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

        if (!empty($this->cedula)) {
            $seguimientos->where('formularios.identificacion', $this->cedula);
        }
        if(!empty($this->nombre)){$seguimientos->where('formularios.nombre', 'LIKE', '%' . $this->nombre . '%');}
        if(!empty($this->color)){
            $color = $this->color;

            if ($color == "Rojo") {
                $seguimientos->where(function($query) {
                    $query->whereRaw('(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                        matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                        matriz_seguimiento.respuesta_siete) <= ?', [4]);
                });
            } elseif ($color == "Amarillo") {
                $seguimientos->where(function($query) {
                    $query->whereRaw('(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                        matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                        matriz_seguimiento.respuesta_siete) >= ?', [5])
                    ->whereRaw('(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                        matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                        matriz_seguimiento.respuesta_siete) <= ?', [6]);
                });
            } elseif ($color == "Verde") {
                $seguimientos->whereRaw('(matriz_seguimiento.respuesta_uno + matriz_seguimiento.respuesta_dos + matriz_seguimiento.respuesta_tres +
                    matriz_seguimiento.respuesta_cuatro + matriz_seguimiento.respuesta_cinco + matriz_seguimiento.respuesta_seis +
                    matriz_seguimiento.respuesta_siete) = ?', [7]);
            }
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
            DB::raw("CASE matriz_seguimiento.respuesta_siete WHEN 1 THEN 'Si' WHEN 0 THEN 'No' END as res_siete")
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
            'Ha participado en actividades de forma frecuente?'
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