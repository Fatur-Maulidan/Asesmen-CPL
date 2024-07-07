<?php

namespace App\Http\Requests;

use App\Enums\JenisKelamin;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class MahasiswaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $nim = $this->segment(count($this->segments()));

        $rules = [
            'nim' => [
                'bail', 'required', 'digits:9',
                Rule::unique('06_MASTER_mahasiswa','nim')
                    ->ignore($nim, 'nim'),
            ],
            'nama' => 'bail|required|regex:/^[a-zA-Z\s.]+$/',
            'jenis_kelamin' => ['bail', 'required', new EnumValue(JenisKelamin::class)],
            'email' => [
                'bail', 'required', 'email', 'ends_with:polban.ac.id',
                Rule::unique('06_MASTER_mahasiswa','email')
                    ->ignore($nim, 'nim'),
            ],
            'tahun_angkatan' => 'bail|required|digits:4',
            'kelas' => 'bail|required',
        ];

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nim.required' => 'NIM perlu diisi.',
            'nim.digits' => 'NIM harus berupa 9 digit angka.',
            'nim.unique' => 'NIM sudah terdaftar.',

            'nama.required' => 'Nama perlu diisi.',
            'nama.regex' => 'Nama tidak valid.',

            'jenis_kelamin.required' => 'Jenis kelamin perlu diisi.',
            'jenis_kelamin.enum' => 'Jenis kelamin tidak valid.',

            'email.required' => 'Email perlu diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.ends_with' => 'Email harus menggunakan domain @polban.ac.id',

            'tahun_angkatan.required' => 'Tahun angkatan perlu diisi.',

            'kelas.required' => 'Kelas perlu diisi.',
        ];
    }
}
