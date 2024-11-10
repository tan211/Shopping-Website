<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required|max:191',
            'password'=>'required',
            'email'=>'required|email|unique:users',
            'avatar'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone'=>'required',
            'address'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute :Khong duoc de trong',
            'max'=>':attribute : Khong duoc qua :max ki tu',
            'email.email'=>':attribute :email sai dinh dang',
            'email.unique'=>':attribute :email da ton tai',
            'avatar.image' => 'Avatar phải là hình ảnh',
            'avatar.mimes' => 'Avatar phải có định dạng: jpeg, png, jpg, gif',
            'avatar.max' => 'Avatar không được vượt quá :max KB',
        ];
    }
}
