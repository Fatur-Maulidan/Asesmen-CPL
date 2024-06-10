<?php

namespace App\Http\Requests;

use App\Models\MataKuliah;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $id = $this->route('mata_kuliah');
        return [
            'kode' => [
                'bail', 'required',
                Rule::unique('06_MASTER_mata_kuliah')->ignore($id),
            ],
            'nama' => 'bail|required',
            'deskripsi' => 'bail|required',
            'jumlah_sks' => 'bail|required|numeric',
        ];
    }
}
