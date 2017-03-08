<?php

namespace opendatalt\issuetracker\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombresources\app\models\HCResources;

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


    /**
     * Images belonging to issue
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function resources ()
    {
        return $this->belongsToMany(HCResources::class, ODIssuesResources::getTableName(), 'issue_id', 'resource_id');
    }
}
