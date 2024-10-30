<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class RegisterUserRequest extends FormRequest
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
            'fullName' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15|unique:users',
            'address' => 'required|string|max:255',
            'birthDay' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d'),
                function ($attribute, $value, $fail) {
                    $age = Carbon::parse($value)->diffInYears(Carbon::now());
                    if ($age < 18) {
                        return $fail('Debes tener al menos 18 años.');
                    }
                }],
        ];
    }
}
