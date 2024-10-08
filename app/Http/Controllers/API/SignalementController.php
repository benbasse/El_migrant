<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Signalement\AddSignalementRequest;
use App\Models\Signalements;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;


class SignalementController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $signalement = Signalements::with([
                'typeSignalement',
                'user' => function ($query) {
                    $query->where('role', 'migrant');
                }
            ])->get();
            if ($signalement->isEmpty()) {
                return response()->json([
                    "sucess" => true,
                    "message" => "La liste des signalements est vide"
                ]);
            } else {
                return $this->succesResponse($signalement, "Liste des signalements");
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddSignalementRequest $request)
    {
        try {
            // dd($request);
            $user = User::where('nom', $request->nom)
                ->where('email', $request->email)
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
                $user->role = "migrant";
                $user->paysActuelle = $request->paysActuelle;
                $user->villeActuelle = $request->villeActuelle;
                $user->email = $request->email;
                $user->password = 'defaulpassword';
                $user->save();
            } else {
                $signalement = new Signalements();
                $signalement->sujet = $request->sujet;
                $signalement->description = $request->description;
                $signalement->user_id = $user->id;
                $signalement->typesignalement_id = $request->typesignalement_id;
                $signalement->date = Carbon::now();
                $signalement->save();
                return $this->succesResponse($signalement, "Signalement enregistré");
            }
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
            $signalement = Signalements::with('user')
                ->with('TypeSignalement')
                ->find($id);
            if ($signalement) {
                return $this->succesResponse($signalement, "Details de cette signalements");
            } else {
                return $this->errorResponse("Cette signalement n'existe pas");
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $signalement = Signalements::find($id);
            if ($signalement) {
                $signalement->delete();
                return response()->json([
                    "sucess" => true,
                    "message" => "Signalement supprimé avec sucess"
                ]);
            } else {
                return $this->errorResponse("Signalement non trouvé");
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
