<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'=>'required|max:191',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'=>'required',
            'content'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute :Không được để trống',
            'title.max' => ':attribute :Tiêu đề không được vượt quá :max ký tự',
            'image.image' => ':attribute :Image phải là hình ảnh',
            'image.mimes' => ':attribute :Image phải có định dạng: jpeg, png, jpg, gif',
            'image.max' => ':attribute :Image không được vượt quá :max KB',
        ];
    }
}
