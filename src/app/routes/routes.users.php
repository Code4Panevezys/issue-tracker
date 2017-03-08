<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('users', ['as' => 'admin.users', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@adminView']);

    Route::group(['prefix' => 'api'], function ()
    {
        Route::get('users', ['as' => 'admin.api.users', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@pageData']);
        Route::get('users/list', ['as' => 'admin.api.users.list', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@list']);
        Route::get('users/search', ['as' => 'admin.api.users.search', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@search']);
        Route::get('users/{id}', ['as' => 'admin.api.users.single', 'middleware' => ['acl:opendata_lt_issue_tracker_users_list'], 'uses' => 'ODIssuesController@getSingleRecord']);
        Route::post('users/{id}/duplicate', ['as' => 'admin.api.users.duplicate', 'middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@duplicate']);
        Route::post('users/restore', ['as' => 'admin.api.users.restore', 'middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@restore']);
        Route::post('users/merge', ['as' => 'admin.api.users.merge', 'middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@merge']);
        Route::post('users', ['middleware' => ['acl:opendata_lt_issue_tracker_users_create'], 'uses' => 'ODIssuesController@create']);
        Route::put('users/{id}', ['middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@update']);
        Route::put('users/{id}/strict', ['as' => 'admin.api.users.update.strict', 'middleware' => ['acl:opendata_lt_issue_tracker_users_update'], 'uses' => 'ODIssuesController@updateStrict']);
        Route::delete('users/{id}', ['middleware' => ['acl:opendata_lt_issue_tracker_users_delete'], 'uses' => 'ODIssuesController@delete']);
        Route::delete('users', ['middleware' => ['acl:opendata_lt_issue_tracker_users_delete'], 'uses' => 'ODIssuesController@delete']);
        Route::delete('users/{id}/force', ['as' => 'admin.api.users.force', 'middleware' => ['acl:opendata_lt_issue_tracker_users_force_delete'], 'uses' => 'ODIssuesController@forceDelete']);
        Route::delete('users/force', ['as' => 'admin.api.users.force.multi', 'middleware' => ['acl:opendata_lt_issue_tracker_users_force_delete'], 'uses' => 'ODIssuesController@forceDelete']);
    });
});
