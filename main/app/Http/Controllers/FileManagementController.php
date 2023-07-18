<?php

namespace App\Http\Controllers;

use App\Exports\FormularioExport;
use App\Exports\MatrizSeguimientoExport;
use App\Imports\FormImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
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

    /**
     * The function imports data from a file and handles any validation errors that occur during the
     * import process.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request. It contains information about the request such as the input data,
     * files, headers, and more.
     * 
     * @return a response back to the previous page.
     */
    public function importFormulario(Request $request)
    {
        try {
            $files = $request->file('file');
            $tipoZona = $request->input('tipo_zona');
            $zona = $request->input('zona');

            $errorMessages = [];

            foreach ($files as $index => $file) {
                $data = [
                    'propietario_id' => $request->input('creador_id'),
                    'candidato_id' => $request->input('candidato_id'),
                    'tipo_zona' => $tipoZona[$index],
                    'zona' => $zona[$index],
                ];

                try {
                   $import=Excel::import(new FormImport($data), $file->store('temp'));
                } catch (ValidationException $e) {
                    $failures = $e->failures();
                    foreach ($failures as $failure) {
                        $errorMessage = "Error en el archivo: " . $file->getClientOriginalName() . "\n\n";
                        $errorMessage .= "Fila: " . $failure->row() . ", Columna: " . $failure->attribute() . ". \n\n";
                        $errorMessage .= "Mensaje: " . $failure->errors()[0];


                        $errorMessages[] = $errorMessage;
                    }
                }
            }

            if (!empty($errorMessages)) {
                $errorMessage = implode('\n\n', $errorMessages);
                Session::flash('message', $errorMessage);
                Session::flash('alert-class', 'alert-danger');

                return back();
            } else {
                Session::flash('message', 'Documentos subidos correctamente!! Recuerda confirmar los datos antes de guardarlos.');
                Session::flash('alert-class', 'alert-success');

                return redirect()->route('pre-formularios');
            }

            return back();
            
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
    }

    //for matriz de seguimiento
    public function exportMatrizSeguimiento(Request $request){
        return Excel::download(new MatrizSeguimientoExport($request->candidato,$request->pregunta,$request->cedula,$request->comuna,$request->barrio,$request->corregimiento), 'matrizSeguimiento.xlsx');
    }
}
