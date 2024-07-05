<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class IndikatorKinerjaRequest extends FormRequest
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
            'id_cpl' => 'bail|sometimes|required_without:id_ik|exists:08_MASTER_capaian_pembelajaran_lulusan,id',
            'id_ik' => 'bail|sometimes|required|exists:09_MASTER_indikator_kinerja,id',
            'cp_induk' => 'bail|required|exists:08_MASTER_capaian_pembelajaran_lulusan,kode',
            'deskripsi_ik' => 'bail|required',
            'rubrik' => 'bail|required|array',
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
            'id_cpl.required' => 'ID Capaian Pembelajaran perlu diisi.',
            'id_cpl.exists' => 'ID Capaian Pembelajaran tidak ditemukan.',

            'id_ik.required' => 'ID Indikator Kinerja perlu diisi.',
            'id_ik.exists' => 'ID Indikator Kinerja tidak ditemukan.',

            'cp_induk.required' => 'Kode Capaian Pembelajaran perlu diisi.',
            'cp_induk.exist' => 'Kode Capaian Pembelajaran tidak ditemukan',

            'deskripsi_ik.required' => 'Deskripsi Indikator Kinerja perlu diisi.',

            'rubrik.required' => 'Rubrik perlu diisi.',
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $rubrik = $this->input('rubrik', []);
            foreach ($rubrik as $value) {
                if (is_null($value)) {
                    $validator->errors()->add('rubrik', 'Mohon lengkapi data untuk deskripsi rubrik.');
                    break;
                }
            }
        });
    }
}
