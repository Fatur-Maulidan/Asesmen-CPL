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
            'nama_prodi' => 'bail|required',
            'jenjang_prodi' => 'bail|required',
            'nomor_prodi' => 'bail|required',
            'kode_prodi' => 'bail|required',
            'koordinator_prodi' => 'bail|required',
            'jurusan_id' => 'bail|required',
        ];
    }
}
