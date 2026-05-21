<?php

namespace App\Http\Requests\Sale;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateSaleRequest extends FormRequest
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
           'customer_id'=>['required','exists:customers,id'],
           'service_id'=>['required','exists:services,id'],
           'price'=>['required','numeric','min:0'],
           'sale_date'=>['required','date'],
           'note'=>['nullable','string','max:1000']
        ];
    }

    public function attributes()
    {
        return [
           'customer_id'=>'Müştəri',
           'service_id'=>'Xidmət',
           'price'=>'Qiymət',
           'sale_date'=>'Tarix',
           'note'=>'Qeyd'
        ];
    }
     public function messages()
    {
        return [
            'customer_id.required'=>':attribute bos ola bilmez',
            'service_id.required'=>':attribute bos ola bilmez',
            'price.required'=>':attribute bos ola bilmez',
            'price.numeric'=>':attribute sadece reqem ola biler',
            'sale_date.required'=>':attribute bos ola bilmez',
            'sale_date.date'=>':attribute sadece date formatında ola biler',
            'note.max'=>':attribute ölçüsü 1000 simvoldan çox olmamalıdır',

        ];
    }
}
