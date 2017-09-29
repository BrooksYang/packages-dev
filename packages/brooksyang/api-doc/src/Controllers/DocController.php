<?php

namespace BrooksYang\ApiDoc\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use ReflectionClass;

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
    private function getModules($routes)
    {
        // 处理路由
        $modules = [];
        foreach ($routes as $route) {
            // 排除 App\Http\Controllers 下的控制器
            if (substr_count($route, '\\') <= 3 ) continue;

            // 拆分路由
            $attr = explode(':', $route);

            // 获取模块
            $controller = str_replace('App\Http\Controllers\\', '', $attr[2]);
            $module = Arr::first(explode('\\', $controller));
            $route = explode('@', $attr[2]);

            // 处理路由信息
            $routeInfo = [
                'module'     => $module,
                'method'     => Arr::first(explode('|', $attr[0])),
                'uri'        => $attr[1],
                'controller' => $route[0],
                'action'     => $route[1],
            ];

            // 获取api文档
            $docs = $this->getDocs($routeInfo['controller'], $routeInfo['action']);
            $routeInfo['name'] = $docs['name'];

            $modules[$module][] = $routeInfo;
        }

        return $modules;
    }

    /**
     * 获取api文档
     *
     * @param $controller
     * @param $action
     * @return mixed
     */
    private function getDocs($controller, $action)
    {
        $reflection = new ReflectionClass($controller);

        $method = $reflection->getMethod($action);
        $docComment = $method->getDocComment();

        preg_match('/\s+\*\s+(.+)/', $docComment, $matches);
        $docs['name'] = $matches[1];

        return $docs;
    }
}
