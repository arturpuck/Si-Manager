<?php

namespace App\Http\Requests\Movies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class MovieCandidateRangeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = $this->query('id') === 'all' ? ['id' => []] : 
        ['id' => ['required', 'exists:movie_candidates']];
        return $rules;
    }

    public function validationData()
    {
        return ['id' => $this->query('id')];
    }

    public function failedValidation(Validator $validator) : never
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->messages()->all()], 400));
    }
}
