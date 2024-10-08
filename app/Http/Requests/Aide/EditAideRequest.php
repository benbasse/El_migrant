<?php

namespace App\Http\Requests\Aide;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditAideRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'numeroTelephone' => 'required|integer|max:20|unique:users,numeroTelephone',
            'dateNaissance' => 'required|date',
            'lieuNaissance' => 'required|string|max:255',
            'situationMatrimoniale' => 'required|string|max:50',
            // 'statut' => 'required|string|max:50',
            // 'estAccompagner' => 'required|boolean',
            'paysActuelle' => 'required|string|max:255',
            'villeActuelle' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,',
        ];
    }


    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'adresse.string' => 'L\'adresse doit être une chaîne de caractères.',
            'adresse.max' => 'L\'adresse ne doit pas dépasser 255 caractères.',
            'numeroTelephone.required' => 'Le numéro de téléphone est obligatoire.',
            'numeroTelephone.integer' => 'Le numéro de téléphone doit être que des chiffres.',
            'numeroTelephone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caractères.',
            'numeroTelephone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'dateNaissance.required' => 'La date de naissance est obligatoire.',
            'dateNaissance.date' => 'La date de naissance doit être une date valide.',
            'lieuNaissance.required' => 'Le lieu de naissance est obligatoire.',
            'lieuNaissance.string' => 'Le lieu de naissance doit être une chaîne de caractères.',
            'lieuNaissance.max' => 'Le lieu de naissance ne doit pas dépasser 255 caractères.',
            'situationMatrimoniale.required' => 'La situation matrimoniale est obligatoire.',
            'situationMatrimoniale.string' => 'La situation matrimoniale doit être une chaîne de caractères.',
            'situationMatrimoniale.max' => 'La situation matrimoniale ne doit pas dépasser 50 caractères.',
            // 'statut.required' => 'Le statut est obligatoire.',
            // 'statut.string' => 'Le statut doit être une chaîne de caractères.',
            // 'statut.max' => 'Le statut ne doit pas dépasser 50 caractères.',
            'estAccompagner.required' => 'Le champ estAccompagner est obligatoire.',
            // 'estAccompagner.boolean' => 'Le champ estAccompagner doit être un booléen.',
            'paysActuelle.required' => 'Le pays actuel est obligatoire.',
            'paysActuelle.string' => 'Le pays actuel doit être une chaîne de caractères.',
            'paysActuelle.max' => 'Le pays actuel ne doit pas dépasser 255 caractères.',
            'villeActuelle.required' => 'La ville actuelle est obligatoire.',
            'villeActuelle.string' => 'La ville actuelle doit être une chaîne de caractères.',
            'villeActuelle.max' => 'La ville actuelle ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.unique' => 'L\'email a déjà été pris.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'erreur de validation',
            'errorList' => $validator->errors()
        ]));
    }
}
