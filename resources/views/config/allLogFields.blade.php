@extends('layouts/main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            日志配置
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i>控制台</a></li>
            <li><a href="{{route('log.index')}}">日志记录</a></li>
            <li class="active">日志配置</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('config.setLogShowFields')}}" role="form" method="post">
                            {{csrf_field()}}
                        <div class="form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <form action="" role="form">
                                    <div class="text-right col-sm-10">

                                    </div>
                                </form>
                            </div>
                            <div class="row table-responsive">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped dataTable">
                                        <thead>
                                        <tr role="row">
                                            <th class="col-sm-6 text-center">字段名称</th>
                                            <th>是否显示</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($allFields)
                                        @foreach($allFields as $field)
                                            <tr>
                                                <td class="text-center">{{$field}}</td>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" value="1" name="{{$field}}" @if(in_array($field,$showFields)) checked="checked" @endif>
                                                            是否显示
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-6">
                                    <a type="button" class="btn btn-info" href="javascript:history.go(-1)">返回</a>
                                    <button type="submit" class="btn btn-primary" style="margin-left: 50%">保存</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
@endsection