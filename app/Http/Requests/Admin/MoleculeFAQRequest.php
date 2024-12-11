<?php

namespace App\Http\Requests\Admin;

use App\Traits\ResponseHandler;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Validator;

/**
 * Class Attribute
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class MoleculeFAQRequest extends FormRequest
{
    use ResponseHandler;

    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tag_id' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'tag_id.required' => translate('the_tag_id_field_is_required!'),
            'question.required' => translate('the_question_field_is_required!'),
            'answer.required' => translate('the_answer_field_is_required!'),
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {

            }
        ];
    }

}
