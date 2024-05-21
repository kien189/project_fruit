<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|unique:products,name,'.$this->id,
            'slug' => 'required|unique:products,slug,'.$this->id,
            // 'photo' => 'required',
            // 'photos' => 'required',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required',
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'Vui lòng điền tên sản phẩm',
        'slug.required' => 'Đường dẫn không được để trống',
        'slug.unique' => 'Đường dẫn đã được sử dụng. Vui lòng chọn một đường dẫn khác.',
        // 'photo.required' => 'Ảnh sản phẩm không được để trống',
        // 'photos.required' => 'Ảnh mô tả không được để trống',
        'price.required' => 'Giá sản phẩm không được để trống và phải là số lớn hơn hoặc bằng 0',
        'price.numeric' => 'Giá sản phẩm phải là một số',
        'price.min' => 'Giá sản phẩm không được nhỏ hơn 0',
        'sale_price.required' => 'Giá khuyến mại không được để trống và phải là số lớn hơn 0',
        'sale_price.numeric' => 'Giá khuyến mại phải là một số',
        'sale_price.min' => 'Giá khuyến mại không được nhỏ hơn 0',
        'description.required' => 'Mô tả không được để trống',
        'category_id.required' => 'Vui lòng chọn danh mục',
    ];
}

}
