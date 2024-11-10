<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'price'=>'required',
            'company'=>'required',
            'image.*'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'detail'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute :Khong duoc de trong',
            'max'=>':attribute : Khong duoc qua :max ki tu',
            'image.image' => 'Avatar phải là hình ảnh',
            'image.mimes' => 'Avatar phải có định dạng: jpeg, png, jpg, gif',
            'image.max' => 'Avatar không được vượt quá :max KB',
        ];
    }
}
