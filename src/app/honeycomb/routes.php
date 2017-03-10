<?php

//opendata-lt/issue-tracker/src/app/routes/routes.issues.php


Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('issues', ['as' => 'admin.issues', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@adminView']);

    Route::group(['prefix' => 'api'], function ()
    {
        Route::get('issues', ['as' => 'admin.api.issues', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@pageData']);
        Route::get('issues/list', ['as' => 'admin.api.issues.list', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@list']);
        Route::get('issues/search', ['as' => 'admin.api.issues.search', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@search']);
        Route::get('issues/{id}', ['as' => 'admin.api.issues.single', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@getSingleRecord']);
        Route::post('issues/{id}/duplicate', ['as' => 'admin.api.issues.duplicate', 'middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@duplicate']);
        Route::post('issues/restore', ['as' => 'admin.api.issues.restore', 'middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@restore']);
        Route::post('issues/merge', ['as' => 'admin.api.issues.merge', 'middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@merge']);
        Route::post('users', ['middleware' => ['acl:opendata_lt_issue_tracker_users_create'], 'uses' => 'ODIssuesController@create']);
        Route::put('issues/{id}', ['middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@update']);
        Route::put('issues/{id}/strict', ['as' => 'admin.api.issues.update.strict', 'middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@updateStrict']);
        Route::delete('issues/{id}', ['middleware' => ['acl:opendata_lt_issue_tracker_users_delete'], 'uses' => 'ODIssuesController@delete']);
        Route::delete('users', ['middleware' => ['acl:opendata_lt_issue_tracker_users_delete'], 'uses' => 'ODIssuesController@delete']);
        Route::delete('issues/{id}/force', ['as' => 'admin.api.issues.force', 'middleware' => ['acl:opendata_lt_issue_tracker_users_force_delete'], 'uses' => 'ODIssuesController@forceDelete']);
        Route::delete('issues/force', ['as' => 'admin.api.issues.force.multi', 'middleware' => ['acl:opendata_lt_issue_tracker_users_force_delete'], 'uses' => 'ODIssuesController@forceDelete']);
    });
});

// for testing purposes
Route::post('api/v1/issues', ['uses' => 'ODIssuesController@create']);

