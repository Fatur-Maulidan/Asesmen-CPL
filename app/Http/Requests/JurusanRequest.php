<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JurusanRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => [
                'bail', 'required', 'regex:/^[a-zA-Z\s]+$/',
                Rule::unique('01_MASTER_jurusan', 'nama')->ignore($this->route('jurusan')),
            ],
            'kategori' => 'bail|required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nama.required' => 'Nama jurusan perlu diisi.',
            'nama.unique' => 'Jurusan sudah terdaftar.',
            'nama.regex' => 'Nama jurusan hanya diisi dengan huruf dan spasi.',

            'kategori.required' => 'Kategori jurusan perlu diisi.',
        ];
    }
}
