<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class IndikatorKinerjaStoreRequest extends FormRequest
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
            'id_cpl' => 'bail|required|exists:08_MASTER_capaian_pembelajaran_lulusan,id',
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
            'id_cpl.required' => 'ID CP perlu diisi.',
            'id_cpl.exists' => 'ID CP tidak ditemukan.',

            'cp_induk.required' => 'Kode CP perlu diisi.',
            'cp_induk.exist' => 'Kode CP tidak ditemukan',

            'deskripsi_ik.required' => 'Deskripsi IK perlu diisi.',

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
