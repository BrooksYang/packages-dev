<?php

namespace BrooksYang\ApiDoc\Controllers;

use BrooksYang\ApiDoc\Facades\Doc;
use BrooksYang\ApiDoc\Traits\DocHelper;
use BrooksYang\ApiDoc\Traits\GuzzleHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DocController extends Controller
{
    use DocHelper, GuzzleHelper;

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
     * @param $module
     * @param $api
     * @return mixed
     */
    public function show($module, $api)
    {
        $api = json_decode(base64_decode($api));

        $routes = $this->getRoutes();
        $route = array_first($routes, function ($item) use ($api) {
            return in_array("$api->controller@$api->action", explode(':', $item));
        });

        $info = $this->getApiInfo($route);
        $params = $this->getApiParams($api->controller, $api->action);

        return view('api_doc::show', compact('info', 'params', 'module'));
    }

    /**
     * 发送请求
     *
     * @param Request $request
     * @return array
     */
    public function send(Request $request)
    {
        $params = $request->all();
        unset($params['_token'], $params['method']);

        return back()->with('params', json_encode($params, JSON_PRETTY_PRINT))->withInput();
    }
}
