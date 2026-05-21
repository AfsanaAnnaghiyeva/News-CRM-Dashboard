<?php

namespace App\Http\Requests\Customer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name'=>['required','string','min:3','max:255'],
            'logo'=>['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'link'=>['nullable','url','max:255']
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'Müştəri adı:',
            'logo'=>'Müştəri loqosu:',
            'link'=>'Veb sayt linki:'
        ];
    }
    public function messages()
    {
        return[
           'name.required'=>':attribute bos ola bilmez',
           'logo.image'=>':attribute mütləq şəkil olmalıdır',
           'logo.mimes'=>':attribute yalnız jpeg,png,jpg, formatlarında ola bilər',
           'link.url'=>':attribute düzgün veb ünvanı olmalıdır(məs: https://google.com)'
        ];
    }
}
