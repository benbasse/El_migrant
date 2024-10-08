<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Aide\AddAideRequest;
use App\Http\Requests\Aide\EditAideRequest;
use App\Models\Aide;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AideController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $aide = Aide::with([
                'user' => function ($query) {
                    $query->where('statut', 'migrant');
                }
            ])->get();
            if ($aide->isEmpty()) {
                return response()->json([
                    "sucess" => false,
                    "message" => "la liste des aides est vide"
                ]);
            } else {
                return $this->succesResponse($aide, "La liste des aides");
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function store(AddAideRequest $request)
    {
        try {
            $user = User::where('nom', $request->nom)
                ->where('prenom', $request->prenom)
                ->where('numeroTelephone', $request->numeroTelephone)
                ->first();
            if (!$user) {
                $user = new User();
                $user->nom = $request->nom;
                $user->prenom = $request->prenom;
                $user->adresse = $request->adresse;
                $user->numeroTelephone = $request->numeroTelephone;
                $user->dateNaissance = $request->dateNaissance;
                $user->lieuNaissance = $request->lieuNaissance;
                $user->situationMatrimoniale = $request->situationMatrimoniale;
                $user->paysActuelle = $request->paysActuelle;
                $user->villeActuelle = $request->villeActuelle;
                $user->statut = "migrant";
                $user->email = $request->email;
                $user->password = 'defaulpassword';
                $user->save();
            }
            $aide = new Aide();
            $aide->date = Carbon::now();
            $aide->user_id = $user->id;
            $aide->save();
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $aide = Aide::find($id);
            if (!$aide) {
                return $this->errorResponse("Cette aide n'existe pas");
            } else {
                return $this->succesResponse($aide, "Details de cette aide");
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EditAideRequest $request, int $id)
    {
        try {
            $user = User::where('nom', $request->nom)
                ->where('prenom', $request->prenom)
                ->where('numeroTelephone', $request->numeroTelephone)
                ->first();
            if (!$user) {
                $user = new User();
                $user->nom = $request->nom;
                $user->prenom = $request->prenom;
                $user->adresse = $request->adresse;
                $user->numeroTelephone = $request->numeroTelephone;
                $user->dateNaissance = $request->dateNaissance;
                $user->lieuNaissance = $request->lieuNaissance;
                $user->situationMatrimoniale = $request->situationMatrimoniale;
                $user->paysActuelle = $request->paysActuelle;
                $user->villeActuelle = $request->villeActuelle;
                $user->statut = "migrant";
                $user->email = $request->email;
                $user->password = 'defaulpassword';
                $user->save();
            }
            $aide = Aide::find($id);
            $aide->date = Carbon::now();
            $aide->user_id = $user->id;
            $aide->save();
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $aide = Aide::find($id);
            if (!$aide) {
                return $this->errorResponse("Cette aide n'existe pas");
            } else {
                $aide->delete();
                return response()->json([
                    "sucess" => true,
                    "message" => "Aide supprimée"
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
