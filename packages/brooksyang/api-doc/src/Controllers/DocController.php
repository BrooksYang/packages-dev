<?php

namespace BrooksYang\ApiDoc\Controllers;

use App\Http\Controllers\Controller;
use BrooksYang\ApiDoc\Facades\Doc;
use BrooksYang\ApiDoc\Traits\DocHelper;

class DocController extends Controller
{
    use DocHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 按模块获取路由
        $modules = Doc::modules();

        dd($modules);

        return view('api_doc::index');
    }
}
