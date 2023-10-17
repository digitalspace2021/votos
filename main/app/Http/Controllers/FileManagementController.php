<?php

namespace App\Http\Controllers;

use App\Exports\AlertaExport;
use App\Exports\FormularioExport;
use App\Exports\MatrizSeguimientoExport;
use App\Exports\PreFormularios\ExportPreService;
use App\Http\Requests\Import\ImportRequest;
use App\Imports\FormImport;
use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class FileManagementController extends Controller
{
    /**
     * Export the form data to an Excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportFormulario(Request $request)
    {
        return Excel::download(new FormularioExport($request), now().'-formulario.xlsx');
    }
    
    /**
     * Display the import form view with a list of all candidates.
     *
     * @return \Illuminate\View\View
     */
    public function importFormularioView()
    {
        $candidatos = Candidato::all();
        return view('formularios.import', compact('candidatos'));
    }
    
    /**
     * Import a form from an Excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importFormulario(ImportRequest $request)
    {
        try {
            $files = $request->file('file');
            $tipoZona = $request->input('tipo_zona');
            $zona = $request->input('zona');

            $errorMessages = [];

            foreach ($files as $index => $file) {
                $data = [
                    'propietario_id' => $request->input('creador_id'),
                    'candidatos' => $request->input('candidatos'),
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
    //for alertas
    public function exportAlerta(Request $request){
        return Excel::download(new AlertaExport($request->cedula,$request->nombre,$request->color), 'Alerta.xlsx');
    }

    /**
     * The function exports a pre-formulario to an Excel file.
     * 
     * @return an Excel file download.
     */
    public function exportPreFormulario(Request $request)
    {
        return Excel::download(new ExportPreService($request), now().'preFormulario.xlsx');
    }
}
