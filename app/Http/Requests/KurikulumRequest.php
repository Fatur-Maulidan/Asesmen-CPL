<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KurikulumRequest extends FormRequest
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
            'tahun' => 'bail|required|unique:03_MASTER_kurikulum,tahun',
            'jumlah_maksimal_rubrik' => 'bail|required',
            'tenggat_tp' => 'bail|required|date',
            'makna_tingkat_kemampuan' => 'bail|required|array',
            'nilai' => 'bail|required|array',
            'program_studi_nomor' => 'bail|required'
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $makna_tingkat_kemampuan = $this->input('makna_tingkat_kemampuan', []);
            foreach ($makna_tingkat_kemampuan as $value) {
                if (is_null($value)) {
                    $validator->errors()->add('makna_tingkat_kemampuan', 'Mohon lengkapi data untuk makna tingkat kemampuan.');
                    break;
                }
            }

            $nilai = $this->input('nilai', []);
            foreach ($nilai as $item) {
                foreach ($item as $value) {
                    if (is_null($value)) {
                        $validator->errors()->add('nilai', 'Mohon lengkapi data untuk nilai.');
                        break;
                    }
                }
            }
        });
    }
}
