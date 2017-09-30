<?php

namespace BrooksYang\ApiDoc\Controllers;

use BrooksYang\ApiDoc\Facades\Doc;
use BrooksYang\ApiDoc\Traits\DocHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
        $method = $request->input('method');
        $url = rtrim($request->url(), $request->path()) . '/' . $request->input('uri');
        $params = $request->except('_token', 'method', 'uri');

        $data = $this->sendRequest($method, $url, $params);

        return back()->with('params', json_encode($data, JSON_PRETTY_PRINT))->withInput();
    }

    /**
     * guzzle 请求
     *
     * @param       $method
     * @param       $url
     * @param array $param
     * @return mixed
     */
    public function sendRequest($method, $url, $param = [])
    {
        // 获取token
        $token = session('token');

        // 发送请求
        $client = new Client(['headers' => ['Authorization' => "Bearer $token"]]);
        $response = $client->request($method, $url, ['json' => $param, 'verify' => false]);

        // 请求状态异常处理
        $code = $response->getStatusCode();
        if ($code != 200) abort($code);

        // 返回数据
        return json_decode((string)$response->getBody(), true);
    }
}
