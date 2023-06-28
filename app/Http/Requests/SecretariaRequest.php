<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecretariaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'nomeSecretaria' => 'required|min:6|max:255',
            'siglaSecretaria' => 'required|min:2|max:10',
        ];
    }

    public function messages()
    {
        return [
            'nomeSecretaria.required' => 'O campo nome da secretaria é obrigatório',
            'nomeSecretaria.min' => 'O campo nome da secretaria deve ter no mínimo 6 caracteres',
            'nomeSecretaria.max' => 'O campo nome da secretaria deve ter no máximo 255 caracteres',
            'siglaSecretaria.required' => 'O campo sigla da secretaria é obrigatório',
            'siglaSecretaria.min' => 'O campo sigla da secretaria deve ter no mínimo 2 caracteres',
            'siglaSecretaria.max' => 'O campo sigla da secretaria deve ter no máximo 15 caracteres'
        ];
    }
}
