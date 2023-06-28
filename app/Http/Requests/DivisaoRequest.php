<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisaoRequest extends FormRequest
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
            'nomeDivisao' => 'required|min:6|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nomeDivisao.required' => 'O campo nome da divisão é obrigatório',
            'nomeDivisao.min' => 'O campo nome da divisão deve ter no mínimo 6 caracteres',
            'nomeDivisao.max' => 'O campo nome da divisão deve ter no máximo 255 caracteres',
        ];
    }
}
