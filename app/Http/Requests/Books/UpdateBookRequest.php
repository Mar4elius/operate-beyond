<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'id'        => 'required|numeric',
            'name'      => 'required|string',
            'year'      => 'required|digits:4',
            'author_id' => 'required|numeric'
        ];
    }
}
