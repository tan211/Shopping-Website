<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            //
            'password'=>'required',
            'email'=>'required|email',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute :Khong duoc de trong',
            'max'=>':attribute : Khong duoc qua :max ki tu',
            'email.email'=>':attribute :email sai dinh dang',
        ];
    }
}
