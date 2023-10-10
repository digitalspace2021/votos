<?php

namespace App\Http\Services\Problems;

use App\Http\Enum\Cargo\CargoEnum;
use App\Models\Candidato;
use App\Models\Edil;
use App\Models\Formulario;
use Illuminate\Http\Request;

class ProblemsService
{
    /**
     * Store the help of an Edil in the database.
     *
     * @param Formulario $problem The problem form.
     * @param Request $request The HTTP request.
     * @return void
     */
    public function storeHelpEdil(Formulario $problem, Request $request): void
    {
        $edil = new Edil();
        $edil->createOrUpdate([
            'formulario_id' => $problem->id,
            'edil_id' => $request->user_edil,
            'asamblea_id' => $request->asamb_edil,
            'concejo' => $request->concejo,
            'alcaldia' => $request->apoyo == 1 ? (bool)$request->alcaldia : null,
            'gobernacion' => $request->apoyo == 1 ? (bool)$request->gobernacion : null,
        ]);
    }

    /**
     * Stores the selected candidates for a problem in the database.
     *
     * @param Formulario $problem The problem to store the candidates for.
     * @param Request $request The HTTP request containing the selected candidates.
     * @return void
     */
    public function storeHelpCandidates(Formulario $problem, Request $request): void
    {
        $candidatos = Candidato::join('cargos', 'cargos.id', 'candidatos.cargo_id')
            ->select('candidatos.id', 'cargos.id as cargo_id', 'cargos.name')
            ->get();

        if ($request->gobernacion && $request->apoyo) {
            $candidato = $candidatos->where('cargo_id', CargoEnum::GOBERNACION)->first();
            $problem->candidatos()->attach($candidato->id);
        }

        if ($request->alcaldia && $request->apoyo) {
            $candidato = $candidatos->where('cargo_id', CargoEnum::ALCALDIA)->first();
            $problem->candidatos()->attach($candidato->id);
        }

        if ($request->concejo) {
            $candidato = $candidatos->where('cargo_id', CargoEnum::GOBERNACION)->first();
            $problem->candidatos()->attach($candidato->id);
        }
    }

    /**
     * Update the help of an Edil for a given problem.
     *
     * @param Formulario $problem The problem to update the help for.
     * @param Request $request The request containing the data to update the help.
     * @return void
     */
    public function updateHelpEdil(Formulario $problem, Request $request): void
    {

        if (!$request->concejo) {
            $problem->candidatos()->where('cargo_id', CargoEnum::CONCEJO)->detach();
        }

        if (!$request->alcaldia || !$request->apoyo) {
            $problem->candidatos()->where('cargo_id', CargoEnum::ALCALDIA)->detach();
        }

        if (!$request->gobernacion || !$request->apoyo) {
            $problem->candidatos()->where('cargo_id', CargoEnum::GOBERNACION)->detach();
        }

        $this->storeHelpEdil($problem, $request);
        $this->storeHelpCandidates($problem, $request);
    }

    /**
     * Clears the candidates and the elected official associated with a given problem.
     *
     * @param Formulario $problem The problem to clear the candidates and elected official from.
     * @return void
     */
    public function clearCandAndEdil(Formulario $problem): void
    {
        $problem->candidatos()->detach();
        $problem->edil()->delete();
    }
}
