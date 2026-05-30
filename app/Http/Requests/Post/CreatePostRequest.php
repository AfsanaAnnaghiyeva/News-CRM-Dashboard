<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class CreatePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required','string','max:255'],
            'content'=>['required','string'],
            'category_id'=>['required','integer'],
            'image'=>['required','image','mimes:jpeg,jpg,png,gif', 'max:2048'],
            'status' => ['required', 'boolean']
        ];
    }

    public function attributes()
    {
        return [
           'title'=>'Başlıq',
           'content'=>'Mezmun',
           'category_id'=>'Kateqoriya',
           'image'=>'Şəkil',
           'status'=>'status'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>':attribute boş ola bilməz',
            'content.required'=>':attribute boş ola bilməz',
            'category_id.required'=>':attribute boş ola bilməz',
            'category_id.int'=>':attribute sadece id ola bilər',
            'image.required'=>':attribute boş ola bilməz',
            'image.mimes'=>':attribute sadece jpeg,jpg,png,gif ola bilər',
            'image.max'=>':attribute ölçüsü 2MB-dan çox olmamalıdır',
            'status.required'=>':attribute seçilməlidir',
            'status.boolean'=>':attribute formati düzgün deyil'

        ];
    }
}
