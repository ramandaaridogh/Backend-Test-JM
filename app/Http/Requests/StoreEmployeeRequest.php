<?php

namespace App\Http\Requests;

use App\Traits\HasApiValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    use HasApiValidation;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // TO DO
        return [
            'nik' => 'required|unique:employees',
            'name' => 'required|string|max:255',
            'unit_id' => 'required',
            'position_name' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'place_of_birth' => 'required',
        ];
    }
}
