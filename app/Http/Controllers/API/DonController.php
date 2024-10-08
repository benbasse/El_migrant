<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Don\AddDonRequest;
use App\Http\Requests\Don\EditDonRequest;
use App\Models\Don;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class DonController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $don = Don::all();
            if ($don->isEmpty()) {
                return response()->json([
                    "sucess" => true,
                    "message" => "La liste des don est vide"
                ]);
            } else {
                return $this->succesResponse($don, "La liste des dons avec les utilisateurs");
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddDonRequest $request)
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
                // $user->statut = "userDon";
                $user->email = $request->email;
                $user->password = 'defaulpassword';
                $user->save();
            }
            $don = new Don();
            $don->montant = $request->montant;
            $don->date = Carbon::now();
            $don->user_id = $user->id;
            $don->save();
            return $this->succesResponse($don, "Don enregistre avec sucess");
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
            $don = Don::whith('user')->find($id);
            if ($don) {
                return $this->succesResponse($don, "Details de ce Don");
            } else {
                return $this->errorResponse("Ce don n'existe pas");
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditDonRequest $request, int $id)
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
                $user->email = $request->email;
                $user->role = "userDon";
                $user->save();
            }
            $don = Don::find($id);
            if ($don) {
                $don->montant = $request->montant;
                $don->date = Carbon::now();
                $don->user_id = $user->id;
                $don->save();
                return $this->succesResponse($don, "Don enregistre avec sucess");
            } else {
                return $this->errorResponse("Ce don n'existe pas");
            }
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
            $don = Don::find($id);
            if ($don) {
                $don->delete();
                return response()->json([
                    "sucess" => true,
                    "message" => "Don supprimé"
                ]);
            } else {
                return $this->errorResponse("Ce don n'existe pas");
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
