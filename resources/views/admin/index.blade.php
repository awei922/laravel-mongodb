@extends('layouts/main')

@section('content')
    {{--content 开始--}}
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">OpenID周榜</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>OpenID</th>
                                <th>数量</th>
                            </tr>
                            @if($openids)
                                @foreach($openids as $k=>$openid)
                                    <tr>
                                        <td>{{++$k}}</td>
                                        <td>{{$openid['_id']}}</td>
                                        <td>{{$openid['openid_cnt']}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div><!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Phone周榜</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Phone</th>
                                <th>数量</th>
                            </tr>
                            @if($phones)
                                @foreach($phones as $k=>$phone)
                                    <tr>
                                        <td>{{++$k}}</td>
                                        <td>{{$phone['_id']}}</td>
                                        <td>{{$phone['phone_cnt']}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div><!-- /.box -->
            </div>

            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">PHP相关信息</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th width="30%">PHP版本</th>
                                <td width="70%">{{phpversion()}}</td>
                            </tr>
                            <tr>
                                <th>运行方式</th>
                                <td>{{php_sapi_name()}}</td>
                            </tr>
                            <tr>
                                <th>时区</th>
                                <td>{{ini_get('date.timezone')}}</td>
                            </tr>
                            <tr>
                                <th>内存限制</th>
                                <td>{{ini_get('memory_limit')}}</td>
                            </tr>
                            <tr>
                                <th>POST限制</th>
                                <td>{{ini_get('post_max_size')}}</td>
                            </tr>
                            <tr>
                                <th>上传限制</th>
                                <td>{{ini_get('upload_max_filesize')}}</td>
                            </tr>
                            <tr>
                                <th>脚本执行时间</th>
                                <td>{{ini_get('max_execution_time')}}秒</td>
                            </tr>
                            <tr>
                                <th>错误显示</th>
                                <td>{{ini_get('display_errors')}}</td>
                            </tr>
                        </table>
                    </div>
                </div><!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">服务器参数</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th width="30%">系统信息</th>
                                <td width="70%">{{php_uname()}}</td>
                            </tr>
                            <tr>
                                <th>服务器域名</th>
                                <td>{{$_SERVER['SERVER_NAME']}}</td>
                            </tr>
                            <tr>
                                <th>服务器IP</th>
                                <td>@if(DIRECTORY_SEPARATOR == '/') {{$_SERVER['SERVER_ADDR']}} @else {{@gethostbyname($_SERVER['SERVER_NAME'])}} @endif</td>
                            </tr>
                            <tr>
                                <th>服务器端口</th>
                                <td>{{$_SERVER['SERVER_PORT']}}</td>
                            </tr>
                            <tr>
                                <th>运行环境</th>
                                <td>{{$_SERVER['SERVER_SOFTWARE']}}</td>
                            </tr>
                            <tr>
                                <th>服务器语言</th>
                                <td>{{$_SERVER['HTTP_ACCEPT_LANGUAGE']}}</td>
                            </tr>
                            <tr>
                                <th>绝对路径</th>
                                <td>{{$_SERVER['DOCUMENT_ROOT']}}</td>
                            </tr>
                            <tr>
                                <th>系统临时目录</th>
                                <td>{{$_SERVER['TEMP']}}</td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    {{--content 结束--}}
@endsection