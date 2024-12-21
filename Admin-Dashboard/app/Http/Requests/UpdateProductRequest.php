<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name_en' => ['required','string','max:256','min:2'],
            'name_ar' => ['required','string','max:256','min:2'],
            'code' => ['required','integer','digits:5',"unique:products,code,id"],
            'price' => ['required','numeric','max:99999.99','min:5'],
            'quantity' => ['nullable','integer','max:999','min:1'],
            'status' => ['required','integer','between:0,1'],
            'brand_id' => ['required','integer','exists:brands,id'],
            'subcategory_id' => ['required','integer','exists:subcategories,id'],
            'desc_en' => ['required','string'],
            'desc_ar' => ['required','string'],
            // validation on (image) file
            'image' => ['nullable','max:100','mimes:jpg,png,jpeg']
        ];
    }
}
