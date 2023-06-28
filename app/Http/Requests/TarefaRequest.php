<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefaRequest extends FormRequest
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
            'nomeTarefa' => 'required|min:6|max:255',
            'descricao' => 'required|min:6|max:255',
            'numeroChamado' => 'max:10',
        ];
    }

    public function messages()
    {
        return [
            'nomeTarefa.required' => 'O campo nome da tarefa é obrigatório',
            'nomeTarefa.min' => 'O campo nome da tarefa deve ter no mínimo 6 caracteres',
            'nomeTarefa.max' => 'O campo nome da tarefa deve ter no máximo 255 caracteres',
            'descricao.required' => 'O campo descrição da tarefa é obrigatório',
            'descricao.min' => 'O campo descrição da tarefa deve ter no mínimo 6 caracteres',
            'descricao.max' => 'O campo descrição da tarefa deve ter no máximo 255 caracteres',
            'numeroChamado.max' => 'O campo número do chamado deve ter no máximo 15 caracteres'
        ];
    }
}
