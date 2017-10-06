<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class GroupController extends Controller
{
    /**
     * 这里是api标题
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 支持以下三种方式接收参数
        $paramA = $request->input('param_a'); // 参数一说明
        $paramB = $request->get('param_b'); // 参数二说明
        $paramC = Input::get('param_c'); // 参数三说明

        // 以下是返回内容
        return response()->json([
            'code' => 1,
            'msg' => 'success',
            'data' => [
                'paramA' => $paramA,
                'paramB' => $paramB,
                'paramC' => $paramC,
            ]
        ]);
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
