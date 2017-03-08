<?php namespace opendatalt\issuetracker\app\validators;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class ODIssuesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'comment' => 'required',
        ];
    }
}