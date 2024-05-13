<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckAllRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'test_id' => ['int', 'required'],
            'answers' => ['array', 'required'],
            'answers.*.task_id' => ['int', 'required'],
            'answers.*.answer' => ['string', 'required'],
        ];
    }
}
