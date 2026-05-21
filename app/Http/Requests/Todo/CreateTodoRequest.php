<?php

namespace App\Http\Requests\Todo;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTodoRequest extends FormRequest
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
        ];
    }
     public function attributes()
    {
        return [
           'title'=>'Tapşırıq'
        ];
    }
      public function messages()
    {
        return [
            'title.required'=>':attribute bos ola bilmez',
            'title.string'=>'Zehmet olmasa :attribute ı mətn formasında yazın',
            'title.max'=>'Yazdığınız :attribute çox uzundur(maksiumum 255 simvol)'
        ];
    }
}
