<?php

namespace BrooksYang\ApiDoc\Traits;

use Illuminate\Support\Arr;
use ReflectionClass;

trait DocHelper
{
    /**
     * 获取路由
     *
     * @return mixed
     */
    protected function getRoutes()
    {
        $path = base_path();

        // 获取api路由
        exec("php $path/artisan route:list|grep -E 'App'|awk '{print $3\":\"$5\":\"$8\":\"$9}'", $routes);

        // 处理数据
        $routes = array_map(function ($item) {
            return str_replace(':|', '', $item);
        }, $routes);

        return $routes;
    }

    /**
     * 获取所有模块
     *
     * @param $routes
     * @return array
     */
    protected function getModules($routes)
    {
        // 筛选 App\Http\Controllers 下的控制器
        $routes = array_filter($routes, function ($item) {
            return substr_count($item, '\\') > 3;
        });

        $modules = [];

        foreach ($routes as $route) {
            $attr = explode(':', $route);

            $module = $this->getModule($attr[2]);

            if (!in_array($module, $modules)) {
                array_unshift($modules, $module);
            }
        }

        return $modules;
    }

    /**
     * 获取模块
     *
     * @param $controller
     * @return mixed
     */
    protected function getModule($controller)
    {
        // 获取模块
        $controller = str_replace('App\Http\Controllers\\', '', $controller);
        $module = Arr::first(explode('\\', $controller));

        return $module;
    }

    /**
     * 按模块获取路由
     *
     * @param $routes
     * @return array
     */
    protected function getRouteInfoByModules($routes)
    {
        // 处理路由
        $modules = [];
        foreach ($routes as $route) {
            // 排除 App\Http\Controllers 下的控制器
            if (substr_count($route, '\\') <= 3 ) continue;

            // 获取模块
            $attr = explode(':', $route);
            $module = $this->getModule($attr[2]);
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
    protected function getDocs($controller, $action)
    {
        $reflection = new ReflectionClass($controller);

        $method = $reflection->getMethod($action);
        $docComment = $method->getDocComment();

        preg_match('/\s+\*\s+(.+)/', $docComment, $matches);
        $docs['name'] = $matches[1];

        return $docs;
    }
}
