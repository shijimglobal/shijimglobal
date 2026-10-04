<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
{
    /**
     * Services a visitor can request a quote for, as translation keys.
     *
     * @var list<string>
     */
    public const SERVICES = [
        'Company website',
        'Online payments',
        'E-commerce',
        'Server setup',
        'Server rental',
        'Other',
    ];

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'service' => ['required', Rule::in(self::SERVICES)],
            'message' => ['required', 'string', 'max:2000'],
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => __('name'),
            'phone' => __('phone'),
            'email' => __('email'),
            'service' => __('service'),
            'message' => __('message'),
        ];
    }

    /**
     * Get the URL to redirect to on a validation error.
     */
    protected function getRedirectUrl(): string
    {
        return self::returnUrl();
    }

    /**
     * The page the form was sent from (contact section), limited to this site to avoid open redirects.
     */
    public static function returnUrl(): string
    {
        $previousUrl = strtok(url()->previous(), '#');
        $isOwnPage = parse_url($previousUrl, PHP_URL_HOST) === request()->getHost();

        return ($isOwnPage ? $previousUrl : route('home')).'#contact';
    }
}
