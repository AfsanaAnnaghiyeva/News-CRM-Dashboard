<?php

namespace App\Http\Requests\Service;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'title'=>['required','string','min:3','max:255'],
            'description'=>['required','string'],
            'price'=>['nullable','numeric','min:0']
        ];
    }

    public function attributes()
    {
        return [
            'title'=>'Xidmetin basligi',
            'description'=>'Xidmetin tesviri',
            'price'=>'Xidmetin qiymeti'
        ];
    }
    public function messages()
    {
        return[
           'title.required'=>':attribute bos ola bilmez',
           'title.min'=>':attribute minimum 3 simvol ola biler',
           'title.max'=>':attribute maksimum 255 simvol ola biler',
           'description.required'=>':attribute bos ola bilmez',
           'price.numeric'=>':attribute reqem olmalidi'
        ];
    }
}
