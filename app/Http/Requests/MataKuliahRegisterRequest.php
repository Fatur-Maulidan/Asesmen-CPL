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
            'id_mata_kuliah.required' => 'ID mata kuliah perlu diisi.',
            'id_mata_kuliah.exists' => 'ID mata kuliah tidak valid.',

            'tahun_mulai.required' => 'Tahun mulai perkuliahan perlu diisi.',
            'tahun_mulai.digits' => 'Tahun mulai perkuliahan harus berupa 4 digit angka.',

            'tahun_selesai.required' => 'Tahun selesai perkuliahan perlu diisi.',
            'tahun_selesai.digits' => 'Tahun selesai perkuliahan harus berupa 4 digit angka.',

            'semester.required' => 'Semester perkuliahan perlu diisi.',
            'semester.digits' => 'Semester harus berupa angka.',

            'jenis.required' => 'Jenis perkuliahan perlu diisi.',

            'dosen_pengampu.required' => 'Dosen pengampu perlu diisi.',

            'indikator_kinerja.required' => 'Indikator kinerja perlu diisi.',
        ];
    }
}
