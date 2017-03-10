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
            'storageURL' => route ('admin.api.issues'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans ('HCCoreUI::core.button.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"    => "singleLine",
                    "fieldID" => "reporter_email",
                    "label"   => trans ("IssueTracker::issues.reporter_email"),
                ], [
                    "type"            => "textArea",
                    "fieldID"         => "comment",
                    "label"           => trans ("IssueTracker::issues.comment"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "rows"            => 10,
                ], [
                    "type"    => "singleLine",
                    "fieldID" => "lat",
                    "label"   => trans ("IssueTracker::issues.lat"),
                ], [
                    "type"    => "singleLine",
                    "fieldID" => "lon",
                    "label"   => trans ("IssueTracker::issues.lon"),
                ], [
                    "label"     => trans ("HCResources::resources.resource"),
                    "type"      => "resource",
                    "fieldID"   => "resources",
                    "uploadURL" => route ("admin.api.resources"),
                    "viewURL"   => route ("resource.get", ['/']),
                    "required"  => 0,
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