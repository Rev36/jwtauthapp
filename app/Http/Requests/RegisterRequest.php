<?php

namespace App\Http\Requests;


use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email'=>'required|email',
            'name'=>'required|string|min:3|max:20',
            
            'password'=>'required|min:6|max:8',
        ];
    }

    public function messages(){
        return [
            'email.required' => __('logincustomer.email.required'),
            'email.email' => __('logincustomer.email.email'),
            'name.required' => __('logincustomer.name.required'),
            'name.string' => __('logincustomer.name.string'),
            'name.min' => __('logincustomer.name.min'),
            'name.max' => __('logincustomer.name.max'),

            'password.required' => __('logincustomer.password.required'),
            
            'password.min' => __('logincustomer.password.min'),
            'password.max' => __('logincustomer.password.max'),
            
           
        ];
    }
}
