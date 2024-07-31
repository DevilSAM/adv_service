<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $perPage
 * @property int $page
 * @property string|null $prop
 * @property string|null $order
 * @property array $immutableFilter
 */
class PaginationSortRequest extends FormRequest
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
            'perPage' => 'integer',
            'page' => 'integer',
            'prop' => 'string|nullable',
            'order' => 'string|nullable',
            'sortColumn' => 'string|nullable',
            'sortDirection' => 'string|nullable',
            'sort_column' => 'string|nullable',
            'sort_direction' => 'string|nullable',
        ];
    }
}
