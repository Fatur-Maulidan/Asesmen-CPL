<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MataKuliahRequest extends FormRequest
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
            'kode' => 'bail|required|unique:06_MASTER_mata_kuliah',
            'nama' => 'bail|required',
            'deskripsi' => 'bail|required',
            'jumlah_sks' => 'bail|required|numeric',
        ];
    }
}
