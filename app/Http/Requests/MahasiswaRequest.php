<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
            'nim' => 'bail|numeric|max:9|required',
            'nama' => 'bail|alpha|required',
            'jenis_kelamin' => 'bail|required',
            'email' => 'bail|email:rfc,dns|required',
            'kelas' => 'bail|required',
            'tahun_angkatan' => 'bail|required'
        ];
    }
}