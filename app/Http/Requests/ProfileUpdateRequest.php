<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'nik' => ['nullable', 'string', 'max:16'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'kontak_darurat' => ['nullable', 'string', 'max:20'],
            'nomor_sim' => ['nullable', 'string', 'max:30'],
            'nama_lembaga' => ['nullable', 'string', 'max:150'],
            'nama_penanggung_jawab' => ['nullable', 'string', 'max:150'],
            'no_wa' => ['nullable', 'string', 'max:30'],
            'alamat_unit' => ['nullable', 'string', 'max:255'],
            'merk_kendaraan' => ['nullable', 'string', 'max:100'],
            'plat_nomor' => ['nullable', 'string', 'max:30'],
            'nomor_stnk' => ['nullable', 'string', 'max:50'],
        ];
    }
}
