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

    /**
     * 获取api详情
     *
     * @param $api
     * @return mixed
     */
    public function show($api)
    {
        $api = explode('|', base64_decode($api));
        $controller = $api[0];
        $action = $api[1];

        $name = $this->getApiName($controller, $action);

        dd($name);
    }
}
