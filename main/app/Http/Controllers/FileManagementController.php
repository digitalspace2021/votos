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

    public function importFormulario()
    {
        try {

            Excel::import(new FormImport, request()->file('file')->store('temp'));

            Session::flash('message', 'Documentos subidos correctamente!!');

            Session::flash('alert-class', 'alert-success');

            return back();

        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
    }
}
