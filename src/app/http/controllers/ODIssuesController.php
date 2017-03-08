<?php namespace opendatalt\issuetracker\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use opendatalt\issuetracker\app\models\ODIssues;
use opendatalt\issuetracker\app\validators\ODIssuesValidator;

class ODIssuesController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView ()
    {
        $config = [
            'title'       => trans ('IssueTracker::users.page_title'),
            'listURL'     => route ('admin.api.users'),
            'newFormUrl'  => route ('admin.api.form-manager', ['users-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['users-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if ($this->user ()->can ('opendata_lt_issue_tracker_users_create'))
            $config['actions'][] = 'new';

        if ($this->user ()->can ('opendata_lt_issue_tracker_users_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if ($this->user ()->can ('opendata_lt_issue_tracker_users_delete'))
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';

        return view ('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader ()
    {
        return [
            'reporter_email' => [
                "type"  => "text",
                "label" => trans ('IssueTracker::users.reporter_email'),
            ],
            'comment'        => [
                "type"  => "text",
                "label" => trans ('IssueTracker::users.comment'),
            ],
            'lat'            => [
                "type"  => "text",
                "label" => trans ('IssueTracker::users.lat'),
            ],
            'lon'            => [
                "type"  => "text",
                "label" => trans ('IssueTracker::users.lon'),
            ],

        ];
    }

    /**
     * Create item
     *
     * @param array|null $data
     * @return mixed
     */
    protected function __create (array $data = null)
    {
        if (is_null ($data))
            $data = $this->getInputData ();

        $record = ODIssues::create (array_get ($data, 'record'));

        return $this->getSingleRecord ($record->id);
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __update (string $id)
    {
        $record = ODIssues::findOrFail ($id);

        $data = $this->getInputData ();

        $record->update (array_get ($data, 'record'));

        return $this->getSingleRecord ($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __updateStrict (string $id)
    {
        ODIssues::where ('id', $id)->update (request ()->all ());

        return $this->getSingleRecord ($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __delete (array $list)
    {
        ODIssues::destroy ($list);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __forceDelete (array $list)
    {
        ODIssues::onlyTrashed ()->whereIn ('id', $list)->forceDelete ();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed|void
     */
    protected function __restore (array $list)
    {
        ODIssues::whereIn ('id', $list)->restore ();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    public function createQuery (array $select = null)
    {
        $with = [];

        if ($select == null)
            $select = ODIssues::getFillableFields ();

        $list = ODIssues::with ($with)->select ($select)
            // add filters
            ->where (function ($query) use ($select) {
                $query = $this->getRequestParameters ($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted ($list);

        // add search items
        $list = $this->listSearch ($list);

        // ordering data
        $list = $this->orderData ($list, $select);

        return $list;
    }

    /**
     * Creating data list
     * @return mixed
     */
    public function pageData ()
    {
        return $this->createQuery ()->paginate ($this->recordsPerPage);
    }

    /**
     * Creating data list based on search
     * @return mixed
     */
    public function search ()
    {
        if (!request ('q'))
            return [];

        //TODO set limit to start search

        return $this->list ();
    }

    /**
     * Creating data list
     * @return mixed
     */
    public function list()
    {
        return $this->createQuery ()->get ();
    }

    /**
     * List search elements
     * @param $list
     * @return mixed
     */
    protected function listSearch (Builder $list)
    {
        if (request ()->has ('q')) {
            $parameter = request ()->input ('q');

            $list = $list->where (function ($query) use ($parameter) {
                $query->where ('reporter_email', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('comment', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('lat', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('lon', 'LIKE', '%' . $parameter . '%');
            });
        }

        return $list;
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData ()
    {
        (new ODIssuesValidator())->validateForm ();

        $_data = request ()->all ();

        array_set ($data, 'record.reporter_email', array_get ($_data, 'reporter_email'));
        array_set ($data, 'record.comment', array_get ($_data, 'comment'));
        array_set ($data, 'record.lat', array_get ($_data, 'lat'));
        array_set ($data, 'record.lon', array_get ($_data, 'lon'));

        return $data;
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function getSingleRecord (string $id)
    {
        $with = [];

        $select = ODIssues::getFillableFields ();

        $record = ODIssues::with ($with)
            ->select ($select)
            ->where ('id', $id)
            ->firstOrFail ();

        return $record;
    }
}