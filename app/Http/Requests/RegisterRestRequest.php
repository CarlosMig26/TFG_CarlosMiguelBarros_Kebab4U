<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRestRequest extends FormRequest
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
            'resName' => 'required|string|max:255',
            'resEmail' => 'required|string|email|max:255|unique:users,email',
            'resPhone' => 'required|string|max:255',
            'resAddress' => 'required|string|max:255',
            'inaugurationDate' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d')],
            'resPassword' => 'required|string|min:8',
        ];
    }
}
