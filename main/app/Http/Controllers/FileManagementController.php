<?php

namespace App\Http\Controllers;

use App\Exports\FormularioExport;
use App\Imports\FormImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class FileManagementController extends Controller
{
    public function exportFormulario()
    {
        return Excel::download(new FormularioExport, 'formulario.xlsx');
    }
    public function importFormularioView()
    {
        return view('formularios.import');
    }

    public function importFormulario(Request $request)
    {
        /* dd(request()->all()); */
        try {
            $files = $request->file('file');
            $tipoZona = $request->input('tipo_zona');
            $zona = $request->input('zona');

            foreach ($files as $index => $file) {
                $data = [
                    'propietario_id' => $request->input('creador_id'),
                    'candidato_id' => $request->input('candidato_id'),
                    'tipo_zona' => $tipoZona[$index],
                    'zona' => $zona[$index],
                ];

                Excel::import(new FormImport($data), $file->store('temp'));
            }

            Session::flash('message', 'Documentos subidos correctamente!! Recuerda Aprobarlos en la sección de Pre-Formularios');
            Session::flash('alert-class', 'alert-success');

            return back();
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
    }
}
