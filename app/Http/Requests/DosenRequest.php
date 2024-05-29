<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
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
            'nama' => 'bail|required',
            'nip' => 'bail|required',
            'kode' => 'bail|required',
            'jenis_kelamin' => 'bail|required',
            'email' => 'bail|required|email',
            'peran' => 'bail|required',
        ];
    }
}
