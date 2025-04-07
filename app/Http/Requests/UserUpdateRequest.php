<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'cedula' => 'required|numeric|min:100000|max:99999999|unique:users,cedula',
            'phone' => 'required|numeric|min:10000000000|max:99999999999|unique:users,phone',
            'nacimiento' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'accountNumberCorriente' => 'required|unique:cuentas,accountNumber',
            'accountNumberAhorro' => 'required|unique:cuentas,accountNumber',
            'availableBalanceCorriente' => 'required|numeric',
            'availableBalanceAhorro' => 'required|numeric',
        ];
    }
}
