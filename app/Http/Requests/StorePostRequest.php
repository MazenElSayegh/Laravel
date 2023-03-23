<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required','min:3','unique:posts'],
            'description'=>['required','min:10'],
            'post_creator' => ['required','exists:users,id'],
            'fileToUpload' => ['mimes:jpeg,png,jpg'],
        ];
    }

}
