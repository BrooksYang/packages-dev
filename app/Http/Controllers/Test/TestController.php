<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TestController extends Controller
{
    /**
     * GET请求测试
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $test = Input::get('test'); // 测试
        $keyword = Input::get('keyword'); // 关键词
        $name = Input::get('name'); // 名称
        $description = Input::get('description'); // 描述

        return response()->json(compact('test', 'keyword', 'name', 'description'));
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
     * POST请求测试
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param1 = $request->input('param1'); // 参数1，必填
        $param2 = $request->input('param2'); // 参数2，必填
        $param3 = $request->input('param3'); // 参数3

        $this->validate($request, ['param1' => 'required', 'param2' => 'required']);

        $message = 'POST请求测试';

        return response()->json(compact('message'));
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
