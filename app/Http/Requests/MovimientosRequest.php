<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimientosRequest extends FormRequest
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
            'cedula' => 'required|numeric|min:100000|max:99999999|exists:users,cedula',
            'phone' => 'required|numeric|min:10000000000|max:99999999999|exists:users,phone',
            'money' => 'required|numeric|min:1|max:1000000',
            'cuentaType' => 'required',
            'concepto' => 'required|max:255',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return[
        '' => ''
        ];
    }
    public function attributes()
    {
        return[
        'name' => 'Nombre',
        'phone' => 'Telefono',
        'money' => 'Dinero',
        'password' => 'contraseña',
        'cuentaType' => 'Cuenta Destino'
        
        ];
    }
}
