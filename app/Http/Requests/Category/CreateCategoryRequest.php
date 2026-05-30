<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class CreateCategoryRequest extends FormRequest
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
            'title'=>['required','min:3','max:24']
        ];
    }
    public function attributes()
    {
        return [
            'title'=>'Kateqoriya'
        ];
    }
    public function messages()
    {
        return [
              'title.required'=>':attribute xanası boş olmamalıdı',
              'title.min'=>'gözlənilən :attribute minimum 3 simvol ola bilər',
              'title.max'=>':attribute maksimum 24 simvol ola bilər',
        ];
    }
}
