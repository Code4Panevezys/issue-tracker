<?php

namespace opendatalt\issuetracker\app\forms;

class ODIssuesForm
{
    // name of the form
    protected $formID = 'users';

    // is form multi language
    protected $multiLanguage = 0;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm (bool $edit = false)
    {
        $form = [
            'storageURL' => route ('admin.api.users'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans ('HCCoreUI::core.button.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "singleLine",
                    "fieldID"         => "reporter_email",
                    "label"           => trans ("IssueTracker::users.reporter_email"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "comment",
                    "label"           => trans ("IssueTracker::users.comment"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "lat",
                    "label"           => trans ("IssueTracker::users.lat"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "lon",
                    "label"           => trans ("IssueTracker::users.lon"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = []; //TOTO implement honeycomb-languages package

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }
}