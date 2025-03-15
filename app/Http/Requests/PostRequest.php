<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postId = $this->route('post');
        return [
            'title' => ['required', 'min:3', Rule::unique('posts')->ignore($postId)],
            'description' => ['required' ,'min:10'],
            'creator' => ['required','exists:users,id'],
            'image' => 'nullable|image|mimes:jpg,png|max:2048',
        ];
    }
}
