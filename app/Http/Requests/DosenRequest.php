<?php

namespace App\Http\Requests;

use App\Models\Master_04_Dosen;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $kode = $this->segment(count($this->segments()));
        return [
            'kode' => ['bail', 'required', Rule::unique('04_MASTER_dosen')->ignore($kode, 'kode')],
            'nip' => ['bail', 'required', Rule::unique('04_MASTER_dosen')->ignore($kode, 'kode')],
            'nama' => 'bail|required',
            'jenis_kelamin' => 'bail|required',
            'email' => ['bail', 'required', 'email', Rule::unique('04_MASTER_dosen')->ignore($kode, 'kode')],
            'jurusan' => 'bail|required',
            'program_studi' => 'sometimes|bail|required|array',
        ];
    }
}
