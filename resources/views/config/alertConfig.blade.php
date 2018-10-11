@extends('layouts/main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            警报配置
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i>控制台</a></li>
            <li><a href="{{route('alert.index')}}">警报记录</a></li>
            <li class="active">警报配置</li>
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
                        <form action="{{route('config.doAlertConfig')}}" role="form" method="post">
                            {{csrf_field()}}
                            <div class="form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="text-right col-sm-10">

                                    </div>
                                </div>
                                <div class="row table-responsive">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-striped dataTable">
                                            <thead>
                                            <tr role="row">
                                                <th class="col-sm-2">配置项</th>
                                                <th>值</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>邮件警报</td>
                                                <td>
                                                    <div class="input-group col-sm-8">
                                                            <span class="input-group-addon" style="width: 100px;">
                                                              <label class="inline">
                                                                  <input type="checkbox" value="true" name="is_email"
                                                                         @if(isset($alertConfig['is_email']) && $alertConfig['is_email']) checked="checked" @endif>
                                                                  是否启用
                                                              </label>
                                                            </span>
                                                        <input class="form-control" type="text" name="email"
                                                               value="{{$alertConfig['email']}}">
                                                    </div>
                                                    <!-- /input-group -->
                                                    <small class="label label-info">请输入邮箱地址，使用","隔开</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>短信警报</td>
                                                <td>
                                                    <div class="input-group col-sm-8">
                                                        <span class="input-group-addon" style="width: 100px;">
                                                          <label class="inline">
                                                              <input type="checkbox" value="true" name="is_sms"
                                                                     @if(isset($alertConfig['is_sms']) && $alertConfig['is_sms']) checked="checked" @endif>
                                                              是否启用
                                                          </label>
                                                        </span>
                                                        <input class="form-control" type="text" name="phone"
                                                               value="{{$alertConfig['phone']}}">
                                                    </div>
                                                        <!-- /input-group -->
                                                    <small class="label label-info">请输入手机号，使用","隔开</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>警报字段</td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon" style="width: 100px;">
                                                            <label class="inline">
                                                                <input type="radio" value="phone"
                                                                       name="alertField"
                                                                       @if(isset($alertConfig['alertField']) && $alertConfig['alertField']=='phone') checked="checked" @endif>
                                                                启用phone
                                                            </label>
                                                        </span>
                                                        <span class="input-group-addon form-control" style="width: 50px;">
                                                            <label class="inline">或</label>
                                                        </span>
                                                        <span class="input-group-addon" style="width: 100px;">
                                                            <label class="inline">
                                                                <input type="radio" value="openid" name="alertField"
                                                                       @if(isset($alertConfig['alertField']) && $alertConfig['alertField']=='openid') checked="checked" @endif>
                                                                启用openID
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                    <div class="input-group">
                                                        <span class="input-group-addon">当超过</span>
                                                        <input class="form-control" type="number"
                                                               style="min-width: 80px;"
                                                               value="{{$alertConfig['alertNum'] ? $alertConfig['alertNum'] : 2}}"
                                                               name="alertNum">
                                                        <span class="input-group-addon">条记录（24小时内），发起警报</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @include('layouts/error')

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