<?php

namespace App\Http\Requests\Movies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Rules\MovieCandidatesAreChosenFromTheBeginning;


class CreateMovieRequest extends FormRequest
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
        return [
            'candidates_ids' => ['required', 'array', new MovieCandidatesAreChosenFromTheBeginning()],
            'candidates_ids.*' => ['required', 'integer', 'exists:movie_candidates,id']
        ];
    }

    public function failedValidation(Validator $validator) : never
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->messages()->all()], 400));
    }
}
