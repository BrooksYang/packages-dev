@extends('api_doc::layouts.app')

@section('css')
    <style>
        span {  width:60px; margin-right: 5px; }
    </style>
@endsection

@section('content')
    <table class="table is-fullwidth is-striped">
        <thead>
        <tr>
            <th>序号</th>
            <th>URI</th>
            <th>名称</th>
            <th>模块</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $key => $item)
            <tr>
                <th>{{ $key + 1 }}</th>
                <td>
                    @if ($item['method'] == 'GET')
                        <span class="tag is-info">{{ $item['method'] }}</span>
                    @elseif ($item['method'] == 'POST')
                        <span class="tag is-success">{{ $item['method'] }}</span>
                    @elseif (in_array($item['method'], ['PUT', 'PATCH']))
                        <span class="tag is-warning">{{ $item['method'] }}</span>
                    @elseif ($item['method'] == 'DELETE')
                        <span class="tag is-danger">{{ $item['method'] }}</span>
                    @endif

                    {{ $item['uri'] }}
                </td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['module'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection