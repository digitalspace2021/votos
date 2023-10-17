<?php

namespace App\Http\Controllers;

use App\Exports\Oportunidades\ExportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FileOportunidadesManagementController extends Controller
{
    /**
     * Export the data to an Excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        return Excel::download(new ExportService($request), 'posibles_votantes_'.now().'.xlsx');
    }
}
