<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServidorStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'dataNascimento' => 'required|date',
            'cpf' => 'required|string|max:14|unique:servidores',
            'matricula' => 'nullable|string|max:8|unique:servidores'
            ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório!',
            'name.string' => 'O campo nome deve ser uma string!',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres!',
            'email.required' => 'O campo email é obrigatório!',
            'email.string' => 'O campo email deve ser uma string!',
            'email.email' => 'O campo email deve ser um email válido!',
            'email.max' => 'O campo email deve ter no máximo 255 caracteres!',
            'email.unique' => 'O email informado já está cadastrado!',
            'dataNascimento.required' => 'O campo data de nascimento é obrigatório!',
            'dataNascimento.date' => 'O campo data de nascimento deve ser uma data válida!',
            'cpf.required' => 'O campo cpf é obrigatório!',
            'cpf.string' => 'O campo cpf deve ser uma string!',
            'cpf.max' => 'O campo cpf deve ter no máximo 14 caracteres!',
            'cpf.unique' => 'O cpf informado já está cadastrado!',
            'matricula.unique' => 'A matricula informada já está cadastrada!',
            'matricula.max' => 'O campo matricula deve ter no máximo 8 caracteres!',
            'matricula.string' => 'O campo matricula deve ser uma string!'
        ];
    }
}
