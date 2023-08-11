<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;

class HelpersValidationController
{
    /**
     * The function checks if a user with the given email exists in the database and returns true if it
     * does, false otherwise.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request made to the server. It contains information about the request, such
     * as the request method, headers, and input data. In this case, the ->email is used to
     * retrieve the email input from the request
     * 
     * @return bool a boolean value. It returns true if a user with the specified email exists in the
     * database, and false otherwise.
     */
    public function validateEmail(Request $request)
    {
        $user = Formulario::where('email', $request->email)
            ->first();

        if ($user) {
            return response()->json(false);
        }

        return response()->json(true);
    }

    public function validateIdentification(Request $request)
    {
        $user = Formulario::where('identificacion', $request->identificacion)
            ->first();

        if ($user) {
            return response()->json(false);
        }

        return response()->json(true);
    }
}
