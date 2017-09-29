<?php

namespace BrooksYang\ApiDoc\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path = base_path();

        // 获取api路由
        exec("php $path/artisan route:list|grep -E 'App'|awk '{print $3\":\"$5\":\"$8}'", $routes);

        // 按模块获取路由
        $modules = $this->getModules($routes);

        dd($modules);


        return view('api_doc::index');
    }

    /**
     * 按模块获取路由
     *
     * @param $routes
     * @return array
     */
    public function getModules($routes)
    {
        // 处理路由
        $modules = [];
        foreach ($routes as $route) {
            // 排除 App\Http\Controllers 下的控制器
            if (substr_count($route, '\\') <= 3 ) continue;

            // 拆分路由
            $route = str_replace('App\Http\Controllers\\', '', $route);
            $attr = explode(':', $route);

            // 拼装数据
            $module = Arr::first(explode('\\', $attr[2]));
            $route = explode('@', $attr[2]);
            $modules[$module][] = [
                'module'     => $module,
                'method'     => Arr::first(explode('|', $attr[0])),
                'uri'        => $attr[1],
                'controller' => Arr::last(explode('\\', $route[0])),
                'action'     => $route[1],
            ];
        }

        return $modules;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
