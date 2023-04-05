<?php

namespace App\Http\Requests;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {

        $this->merge([
            'user_id' => Auth::id(),
        ]);        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title'         => ['required','string'],
            'content'       => ['required','string'],
            'excerpt'       => ['string','max:400'],
            'user_id'       => ['required','exists:users,id'],
            'slug'          => ['unique:posts,slug'],
            'status'        => ['required','string'],
            'categories'    => ['required','array'],
            'tags'          => ['array'],
        ];
    }
}
