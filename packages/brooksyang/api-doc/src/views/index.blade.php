@extends('api_doc::layouts.app')

@section('content')
    <table class="table is-fullwidth is-striped">
        <thead>
        <tr>
            <th>序号</th>
            <th>请求方法</th>
            <th>uri</th>
            <th>名称</th>
            <th>查看</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $key => $item)
            <tr>
                <th>{{ $key + 1 }}</th>
                <td>{{ $item['method'] }}</td>
                <td>{{ $item['uri'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>点击测试</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection