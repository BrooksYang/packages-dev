<?php

namespace BrooksYang\ApiDoc;

use BrooksYang\ApiDoc\Traits\DocHelper;

class Doc
{
    use DocHelper;

    /**
     * 获取路由
     *
     * @return mixed
     */
    public function routes()
    {
        return $this->getRoutes();
    }

    /**
     * 获取模块
     *
     * @return array
     */
    public function modules()
    {
        $routes = $this->getRoutes();

        return $this->getModules($routes);
    }

    /**
     * 获取指定模块下的api
     *
     * @param $module
     * @return array
     */
    public function api($module)
    {
        $routes = $this->getRoutes();

        return $this->getApiByModule($routes, $module);
    }
}
