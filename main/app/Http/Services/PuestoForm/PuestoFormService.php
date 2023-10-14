<?php

namespace App\Http\Services\PuestoForm;

use Illuminate\Support\Facades\DB;

class PuestoFormService
{
    /**
     * Define the name of a voting station based on its ID or return a string to change it.
     *
     * @param int|string $puesto The ID of the voting station or a string to change it.
     * @return string The name of the voting station or a string to change it.
     */
    public function define($puesto)
    {
        if (is_numeric($puesto)) {
            $convert = DB::table('puestos_votacion AS pv')
                ->select(DB::raw("CONCAT('Puesto: ', COALESCE(pv.name, 'Sin información'), ', ', 
                CASE
                    WHEN pv.zone_type = 'Comuna' THEN CONCAT('Barrio: ', COALESCE(barrios.name, 'Sin información'))
                    WHEN pv.zone_type = 'Corregimiento' THEN CONCAT('Vereda: ', COALESCE(veredas.name, 'Sin información'))
                END) AS puesto_nombre, pv.id"))
                ->leftJoin('barrios', function ($join) {
                    $join->on('pv.zone', '=', 'barrios.id')
                        ->where('pv.zone_type', '=', 'Comuna');
                })
                ->leftJoin('veredas', function ($join) {
                    $join->on('pv.zone', '=', 'veredas.id')
                        ->where('pv.zone_type', '=', 'Corregimiento');
                })
                ->where('pv.id', $puesto)
                ->first();

            $convert = $convert->puesto_nombre ?? "Sin información";
        } else {
            $convert = "Cambiar - $puesto";
        }
        return $convert;
    }

    /**
     * Returns a list of voting stations with their names and zones.
     *
     * @param string|null $form The name of the form table to join with the voting stations table.
     * @param bool $ocuped Whether to include only occupied voting stations or not.
     * @return \Illuminate\Support\Collection A collection of voting stations with their names and IDs.
     */
    public function puestos($form=null, $ocuped = false)
    {
        $puestos = DB::table('puestos_votacion AS pv')
            ->select(DB::raw("CONCAT('Puesto: ', COALESCE(pv.name, 'Sin información'), ', ', 
                CASE
                    WHEN pv.zone_type = 'Comuna' THEN CONCAT('Barrio: ', COALESCE(barrios.name, 'Sin información'))
                    WHEN pv.zone_type = 'Corregimiento' THEN CONCAT('Vereda: ', COALESCE(veredas.name, 'Sin información'))
                END) AS puesto_nombre, pv.id"))
            ->leftJoin('barrios', function ($join) {
                $join->on('pv.zone', '=', 'barrios.id')
                    ->where('pv.zone_type', '=', 'Comuna');
            })
            ->leftJoin('veredas', function ($join) {
                $join->on('pv.zone', '=', 'veredas.id')
                    ->where('pv.zone_type', '=', 'Corregimiento');
            })
            ->when($ocuped, function ($query) use ($form) {
                $form = $form=='formularios_pr' ? 'formularios' : $form; 
                $query->join($form, 'pv.id', '=', "$form.puesto_votacion");
            })
            ->when($form, function ($query) use ($form) {
                if ($form=='formularios_pr') {
                    $query->where('formularios.estado', false);
                }
            })
            ->groupBy('pv.id')
            ->get();

        return $puestos;
    }
}
