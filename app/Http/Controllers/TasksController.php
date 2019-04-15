<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Tasks\TasksService;

class TasksController extends Controller
{

    /**
     * @var TasksService
     */
    private $service;

    /**
     * PromoCodesController constructor.
     */
    public function __construct()
    {
        $this->service = app()->make(TasksService::class);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function task_2_1(Request $request)
    {
        $type_processing = $request->input('type_processing', 'eloquent');

        return $this->service->getDataTask2_1($type_processing);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function task_2_2(Request $request)
    {
        $type_processing = $request->input('type_processing', 'eloquent');

        return $this->service->getDataTask2_2($type_processing);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function task_3_1(Request $request)
    {
        $type_processing = $request->input('type_processing', 'eloquent');

        return $this->service->getDataTask3_1($type_processing);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function task_3_2(Request $request)
    {
        $type_processing = $request->input('type_processing', 'eloquent');

        return $this->service->getDataTask3_2($type_processing);
    }

}