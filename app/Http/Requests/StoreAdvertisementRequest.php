<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertisementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'target_url' => ['required', 'url', 'max:2048'],
            'banner_url' => ['nullable', 'url', 'max:2048'],
            'type' => ['required', 'in:TEXT,BANNER'],
            'initial_credits' => ['nullable', 'integer', 'min:0', 'max:500000'],
        ];
    }
}
