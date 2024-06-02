<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
        return true;
    }

    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = false;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'nim' => ['required', 'numeric', 'regex:/^\w{9}$/'],
            'nama' => 'required',
            'jenis_kelamin' => ['required', 'regex:/^\w{1}$/'],
            'email' => ['required', 'email:rfc,dns', 'regex:/polban\.ac\.id/', 'required'],
            'tahun_angkatan' => ['required', 'regex:/^\w{4}$/', 'required'],
            'kelas' => ['required', 'regex:/^\w{1}$/', 'required'],
        ];

        // Additional rules for AJAX requests
        if ($this->ajax()) {
            $rules['status'] = 'required';
        }

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
            // NIM error messages
            'nim.numeric' => 'NIM harus berupa angka',
            'nim.regex' => 'NIM harus 9 karakter',
            'nim.required' => 'NIM harus diisi',

            // Nama error messages
            'nama.alpha' => 'Nama harus berupa huruf',
            'nama.required' => 'Nama harus diisi',

            // Jenis Kelamin error messages
            'jenis_kelamin.required' => 'Jenis Kelamin harus diisi',
            'jenis_kelamin.regex' => 'Pilih salah satu',

            // Email error messages
            'email.email' => 'Email tidak valid',
            'email.required' => 'Email harus diisi',
            'email.regex' => 'Email harus menggunakan domain polban.ac.id',

            // Tahun Angkatan error messages
            'tahun_angkatan.required' => 'Tahun Angkatan harus diisi',
            'tahun_angkatan.regex' => 'Pilih salah satu',

            // Kelas error messages
            'kelas.required' => 'Kelas harus diisi',
            'kelas.regex' => 'Pilih salah satu'
        ];
    }
}
