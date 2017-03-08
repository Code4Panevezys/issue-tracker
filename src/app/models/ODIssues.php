<?php

namespace opendatalt\issuetracker\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class ODIssues extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'od_issues';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'reporter_email', 'comment', 'lat', 'lon'];

}
