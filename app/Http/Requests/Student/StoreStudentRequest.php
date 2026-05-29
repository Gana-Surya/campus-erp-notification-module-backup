<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Allow request authorization.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for student creation.
     */
    public function rules(): array
    {
        return [

            // Admission number must be unique
            'admission_number' => [
                'required',
                'string',
                'max:50',
                'unique:students,admission_number'
            ],

            // Student name
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            // Stream
            'stream' => [
                'required',
                'in:Science,Arts'
            ],

            // Course
            'course' => [
                'required',
                'string',
                'max:100'
            ],

            // Semester
            'semester' => [
                'required',
                'integer',
                'min:1',
                'max:6'
            ],

            // Reservation category
            'category' => [
                'required',
                'in:GEN,OBC,SC,ST'
            ],

            // Optional email
            'email' => [
                'nullable',
                'email'
            ],

            // Optional phone
            'phone' => [
                'nullable',
                'string',
                'max:20'
            ]
        ];
    }
}