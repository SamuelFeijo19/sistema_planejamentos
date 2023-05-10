<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmaRecuperacaoSenhaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'email.exists' => 'O email informado não existe',
            'password.required' => 'O campo senha é obrigatório',
            'password.min' => 'O campo senha deve ter no mínimo 6 caracteres',
            'password.confirmed' => 'O campo senha e confirmação de senha devem ser iguais',
            'password_confirmation.required' => 'O campo confirmação de senha é obrigatório',
        ];
    }
}
