<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    { 

        //dd($this->route());
        //dd($this->method());

        //return false;
        return true;
    }

    /* public function rules()
    {
        return [
            'title' => 'required|string',
            'slug' => 'nullable|string',
            'date' => 'date_format:Y-m-d H:i'
        ];
    } */
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id'
        ];
    }

    public function attributes()
    {
        return [
            'company_id' => 'company',
            'email' => 'email address'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'The email that you entered is not valid',
            '*.required' => ':attribute cannot be empty'
        ];
    }

    /* If Need to perfprm some data manipulation from user to make data valid */
    /* protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->title && !$this->slug ? Str::slug($this->title) : $this->slug,
            //'slug' => $this->input('title') && !$this->input('slug') ? $this->string('title')->slug()->value : $this->slug,
            'date' => $this->date('date')->format('Y-m-d H:i')
        ]);
    } */
}
