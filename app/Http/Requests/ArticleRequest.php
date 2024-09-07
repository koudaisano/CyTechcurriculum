<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'product_name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'company_id' => 'required|exists:companies,id',
            'comment' => 'nullable',
            'img_path' => 'nullable|image',
        ];
    }

    public function messages()
    {
        return[
        'product_name.required' => '商品名は入力必須項目です。',
        'product_name.max' => '商品名は255文字以内で入力してください。',
        'price.required' => '価格は入力必須項目です。',
        'price.numeric' => '価格には数字のみを入力してください。',
        'stock.required' => '在庫は入力必須項目です。',
        'stock.numeric' => '在庫数には数字のみを入力してください。',
        'company_id.required' => 'メーカー名は選択必須です。',
        ];
    }
}
