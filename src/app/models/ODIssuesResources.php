<?php

namespace opendatalt\issuetracker\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class ODIssuesResources extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'od_issues_resources';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['issue_id', 'resource_id'];

}
