<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //         'name'=>'required:products',
    //         'slug'=>'required:products',
    //         'photo'=>'required:products',
    //         'photos'=>'required:products',
    //         'price'=>'required:products',
    //         'sale_price'=>'required|numeric|min0:products',
    //         'description'=>'required|numeric|min0:products',
    //         'category_id'=>'required|number:products',
    //     ];
    // }
    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'required',
            'photo' => 'required',
            'photos' => 'required',
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
            'photo.required' => 'Ảnh sản phẩm không được để trống',
            'photos.required' => 'Ảnh mô tả không được để trống',
            'price.required' => 'Giá sản phẩm không được để trống và phải là số lớn hơn hoặc bằng 0',
            'price.numeric' => 'Giá sản phẩm phải là một số',
            'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0',
            'sale_price.required' => 'Giá khuyến mại không được để trống và phải là số lớn hơn 0',
            'sale_price.numeric' => 'Giá khuyến mại phải là một số',
            'sale_price.min' => 'Giá khuyến mại phải lớn hơn 0',
            'description.required' => 'Mô tả không được để trống',
            'category_id.required' => 'Vui lòng chọn danh mục',
        ];
    }
}
