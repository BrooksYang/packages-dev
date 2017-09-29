<?php

namespace BrooksYang\ApiDoc\Controllers;

use App\Http\Controllers\Controller;
use BrooksYang\ApiDoc\Facades\Doc;
use BrooksYang\ApiDoc\Traits\DocHelper;

class DocController extends Controller
{
    use DocHelper;

    /**
     * api 列表
     *
     * @param $module
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($module = '')
    {
        $items = Doc::api($module);

        return view('api_doc::index', compact('items'));
    }
}
