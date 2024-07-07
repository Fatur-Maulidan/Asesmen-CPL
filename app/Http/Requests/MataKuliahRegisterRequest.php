<?php

namespace App\Http\Requests;

use App\Enums\JenisPerkuliahan;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MataKuliahRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('koordinator program studi');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_mata_kuliah' => 'bail|required|exists:07_MASTER_mata_kuliah,id',
            'tahun_mulai' => 'bail|required|digits:4',
            'tahun_selesai' => 'bail|required|digits:4',
            'semester' => 'bail|required|digits:1',
            'jenis' => ['bail', 'required', new EnumValue(JenisPerkuliahan::class)],
            'dosen_pengampu' => 'bail|required|array',
            'indikator_kinerja' => 'bail|required|array',
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
            'kode.required' => 'Kode mata kuliah perlu diisi.',
            'kode.unique' => 'Kode mata kuliah sudah terdaftar.',

            'nama.required' => 'Nama mata kuliah perlu diisi.',

            'deskripsi.required' => 'Deskripsi mata kuliah perlu diisi.',
        ];
    }
}
