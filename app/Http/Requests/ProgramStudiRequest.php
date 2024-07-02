<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProgramStudiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_jurusan' => 'bail|sometimes|required',
            'nama' => 'bail|required|max:50|regex:/^[a-zA-Z\s]+$/',
            'kode' => [
                'bail', 'required',
                Rule::unique('02_MASTER_program_studi', 'kode')->ignore($this->route('program_studi'))
            ],
            'jenjang_pendidikan' => 'bail|required',
            'id_dosen' => 'bail|nullable',
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
            'id_jurusan.required' => 'Id Jurusan studi perlu diisi.',

            'nama.required' => 'Nama program studi perlu diisi.',
            'nama.max' => 'Nama program studi maksimal 50 karakter.',
            'nama.regex' => 'Nama program studi hanya diisi dengan huruf dan spasi.',

            'kode.required' => 'Kode program studi perlu diisi.',
            'kode.unique' => 'Kode program studi sudah terdaftar.',

            'jenjang_pendidikan.required' => 'Jenjang pendidikan program studi perlu diisi.',
        ];
    }
}
