<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $status
 */
class TagAddRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tag' => 'required',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'tag.required' => translate('the_name_field_is_required'),
            'description.required' => translate('the_description_is_required'),
        ];
    }

}
