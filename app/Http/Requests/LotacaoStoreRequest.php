<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LotacaoStoreRequest extends FormRequest
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
            'servidor_id' => 'required',
            'departamento_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'servidor_id.required' => 'O campo servidor é obrigatório',
            'departamento_id.required' => 'O campo departamento é obrigatório'
        ];
    }
}
