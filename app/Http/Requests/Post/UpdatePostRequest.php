<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'image'=>['nullable','image','mimes:jpeg,jpg,png,gif', 'max:2048'],
            'status' => ['required', 'boolean']
        ];
    }

    public function attributes()
    {
        return [
           'title'=>'Başlıq',
           'content'=>'Mezmun',
           'category_id'=>'Kateqoriya',
           'image'=>'Sekil',
           'status'=>'status'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>':attribute bos ola bilmez',
            'content.required'=>':attribute bos ola bilmez',
            'category_id.required'=>':attribute bos ola bilmez',
            'category_id.int'=>':attribute sadece id ola biler',
            'image.mimes'=>':attribute sadece jpeg,jpg,png,gif ola biler',
            'image.max'=>':attribute ölçüsü 2MB-dan çox olmamalıdır',
            'status.required'=>':attribute secilmelidir',
            'status.boolean'=>':attribute formati duzgun deyil'

        ];
    }
}
