<?php

namespace BrooksYang\ApiDoc\Traits;

use GuzzleHttp\Client;

trait GuzzleHelper
{
    /**
     * post接口调用
     *
     * @param        $url
     * @param array  $param
     * @return mixed
     */
    public function curlPost($url, $param = [])
    {
        // 获取token
        $token = session('token');

        // 获取base url
        $url = rtrim(config('api.base_url'), '/') . '/' . ltrim($url, '/');

        // 发送请求
        $client = new Client(['headers' => ['Authorization' => "Bearer $token"]]);
        $response = $client->request('POST', $url, ['json' => $param, 'verify' => false]);

        // 请求状态异常处理
        $code = $response->getStatusCode();
        if ($code != 200) abort($code);

        // 返回数据
        $data = json_decode((string)$response->getBody(), true);

        return $data;
    }
}
