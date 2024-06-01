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
            'tahun' => 'bail|required',
            'jumlah_maksimal_rubrik' => 'bail|required',
            'makna_tingkat_kemampuan' => 'bail|required',
            'nilai' => 'bail|required',
        ];
    }
}
