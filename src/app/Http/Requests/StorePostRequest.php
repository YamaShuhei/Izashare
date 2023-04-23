<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        #バリデーションの設定
        return [
        'title' => [
          'string',
          'required',
          'max:20',
        ],
        'image' => [
          'file',
          'mimes:jpeg,jpg,png',
        ],
        'description' => [
          'string',
          'required',
          'max:60',
        ],
        ];
    }
}
