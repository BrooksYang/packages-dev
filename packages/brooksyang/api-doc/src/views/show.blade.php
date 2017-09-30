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
            width: 80px;
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <form action="">
        <div class="">
            <a href="javascript:history.back();" class="button button-custom">返回</a>
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
            请求参数：
            <hr>
            <table class="table is-fullwidth">
                <thead>
                <tr>
                    <th class="">序号</th>
                    <th>参数</th>
                    <th>值</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($params as $key => $param)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $param['param'] }}</td>
                        <td>
                            <input class="input" type="email" placeholder="{{ $param['comment'] }}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="box">
            返回结果：
            <hr>
            <pre>
                test
            </pre>
        </div>
    </form>
@endsection
