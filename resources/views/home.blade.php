@extends('layouts.app')
@section('css')
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>--}}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div style="text-align: center">
                        <span>
                            Congratulations ! You are logged in! <br>
                            This is click108 recently data. <br>
                        </span>

                        <span style="font-size: 25px;font-weight: bold;">今天日期:{{$today}}</span>
                    </div>


                        <table class="table table-dark table-hover">
                            <thead>
                            <tr>
                                <th style="width: 8%">星座名稱</th>
                                <th style="width: 23%">整體運勢</th>
                                <th style="width: 23%">愛情運勢</th>
                                <th style="width: 23%">事業運勢</th>
                                <th style="width: 23%">財運運勢</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $key => $value)
                                <tr>

                                <td>{{$key}}</td>
                                @foreach($value as $k => $v)
                                    @if($k === "整體運勢")<td><span style="color: #69b015">{{$v[0]}}</span><br>{{$v[1]}}</td>@endif
                                    @if($k === "愛情運勢")<td><span style="color: #d82f5a">{{$v[0]}}</span><br>{{$v[1]}}</td>@endif
                                    @if($k === "事業運勢")<td><span style="color: #027bad">{{$v[0]}}</span><br>{{$v[1]}}</td>@endif
                                    @if($k === "財運運勢")<td><span style="color: #d95c00">{{$v[0]}}</span><br>{{$v[1]}}</td>@endif
                                @endforeach
                                </tr>

                            @endforeach
                            </tbody>
                        </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
