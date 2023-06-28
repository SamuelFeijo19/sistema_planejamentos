<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartamentoRequest extends FormRequest
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
            'nomeDepartamento' => 'required|min:6|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nomeDepartamento.required' => 'O campo nome do departamento é obrigatório',
            'nomeDepartamento.min' => 'O campo nome do departamento deve ter no mínimo 6 caracteres',
            'nomeDepartamento.max' => 'O campo nome do departamento deve ter no máximo 255 caracteres',
        ];
    }
}
