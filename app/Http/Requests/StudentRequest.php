<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:students,email',
            'matricule' => 'required|unique:students,matricule',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'birth_date' => 'nullable|date',
            'profile_photo' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

}
