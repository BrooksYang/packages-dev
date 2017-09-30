@extends('api_doc::layouts.app')

@section('css')
    <style>
        span {
            width: 60px;
            margin-right: 5px;
        }

        td a {
            color: #363636;
        }

        .button-custom {
            width: 100px;
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <form action="{{ url('api/send') }}" method="POST">
        {{ csrf_field() }}

        {{-- request info--}}
        <input type="hidden" name="method" value="{{ $info['method'] }}">
        <input type="hidden" name="uri" value="{{ $info['uri'] }}">

        {{-- Button --}}
        <div class="">
            <a href="{{ url("api/docs/$module") }}" class="button button-custom">接口列表</a>
            <button class="button is-outlined is-primary button-custom" type="submit">测试</button>
        </div>

        <div class="box">
            <p>
                <span class="tag is-rounded is-primary">HTTP</span><strong>{{ $info['name'] }}</strong>
                <br>

                {{-- method --}}
                @if ($info['method'] == 'GET')
                    <span class="tag is-rounded is-info">{{ $info['method'] }}</span>
                @elseif ($info['method'] == 'POST')
                    <span class="tag is-rounded is-success">{{ $info['method'] }}</span>
                @elseif (in_array($info['method'], ['PUT', 'PATCH']))
                    <span class="tag is-rounded is-warning">{{ $info['method'] }}</span>
                @elseif ($info['method'] == 'DELETE')
                    <span class="tag is-rounded is-danger">{{ $info['method'] }}</span>
                @endif
                {{ $info['uri'] }}
            </p>
        </div>

        <div class="box">
            请求头部：
            <hr>
            <div class="field has-addons">
                <p class="control">
                    <a class="button">Authorization: Bearer</a>
                </p>
                <p class="control is-expanded">
                    <input class="input" type="text" name="token" value="{{ old('token') }}" placeholder="请输入token">
                </p>
                <p class="control">
                    <a class="button">Remember Token</a>
                </p>
            </div>
        </div>

        <div class="box">
            请求参数：
            <hr>
            <table class="table is-fullwidth is-narrow">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>值</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($params as $key => $param)
                    <tr>
                        <td>{{ $param['param'] }}</td>
                        <td>
                            <input class="input" type="text" name="{{ $param['param'] }}"
                                   value="{{ old($param['param']) }}"
                                   placeholder="{{ $param['comment'] }}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="box">
            返回结果：
            <hr>
            <pre>{{ session('params') }}</pre>
        </div>
    </form>
@endsection
