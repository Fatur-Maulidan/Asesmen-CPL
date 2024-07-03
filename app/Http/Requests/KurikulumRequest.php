<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KurikulumRequest extends FormRequest
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
            'program_studi_id' => 'bail|required',
            'tahun' => 'bail|required|unique:03_MASTER_kurikulum,tahun',
            'tenggat_tp' => 'bail|required|date',
            'threshold' => 'bail|required|integer|min:1|max:100',
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
            'program_studi_id.required' => 'Id program studi perlu ada.',

            'tahun.required' => 'Tahun perlu diisi.',
            'tahun.unique' => 'Tahun sudah terdaftar sebelumnya.',

            'tenggat_tp.required' => 'Tanggal batas perlu diisi.',
            'tenggat_tp.date' => 'Tanggal batas tidak valid.',

            'threshold.required' => 'Threshold perlu diisi.',
            'threshold.integer' => 'Threshold diisi dengan angka bulat.',
            'threshold.min' => 'Nilai threshold minimal 1.',
            'threshold.max' => 'Nilai threshold maksimal 100.',
        ];
    }
}
