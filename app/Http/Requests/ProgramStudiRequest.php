<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramStudiRequest extends FormRequest
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
            'nomor' => 'bail|required',
            'nama' => 'bail|required',
            'kode' => 'bail|required',
            'jenjang_pendidikan' => 'bail|required',
            'koordinator_prodi' => 'bail|nullable',
            'jurusan_nomor' => 'bail|required',
        ];
    }
}
