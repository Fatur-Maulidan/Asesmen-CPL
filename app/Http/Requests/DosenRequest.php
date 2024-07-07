<?php

namespace App\Http\Requests;

use App\Models\Master_04_Dosen;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
        return Auth::user()->hasRole('admin') || Auth::user()->hasRole('koordinator program studi');
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
            'id' => 'bail|sometimes|required|integer|exists:04_MASTER_dosen,id',
            'kode' => [
                'bail', 'required',
                Rule::unique('04_MASTER_dosen')->ignore($kode, 'id')
            ],
            'nip' => [
                'bail', 'required',
                Rule::unique('04_MASTER_dosen')->ignore($kode, 'id')
            ],
            'nama' => 'bail|required|regex:/^[a-zA-Z\s.,]+$/',
            'jenis_kelamin' => 'bail|required',
            'email' => [
                'bail', 'required', 'email', 'ends_with:@polban.ac.id',
                Rule::unique('04_MASTER_dosen')->ignore($kode, 'id')
            ],
            'jurusan' => 'bail|sometimes|required',
            'program_studi' => 'sometimes|bail|required|array',
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
            'kode.required' => 'Kode dosen perlu diisi.',
            'kode.unique' => 'Kode dosen sudah terdaftar.',

            'nip.required' => 'NIP dosen perlu diisi.',
            'nip.unique' => 'NIP dosen sudah terdaftar.',

            'nama.required' => 'Nama dosen perlu diisi.',
            'nama.regex' => 'Nama dosen hanya diisi dengan huruf, spasi, titik dan koma.',

            'jenis_kelamin.required' => 'Nama dosen perlu diisi.',

            'email.required' => 'Email dosen perlu diisi.',
            'email.email' => 'Email tidak valid.',

            'jurusan.required' => 'Jurusan perlu diisi.',
        ];
    }
}
