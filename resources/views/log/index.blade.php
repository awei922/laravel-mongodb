@extends('layouts/main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            日志记录
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i>控制台</a></li>
            <li class="active">日志记录</li>
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
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-2">
                                    <a class="btn btn-info" href="{{route('config.allLogFields')}}">配置显示字段</a>
                                </div>
                                <form action="" role="form">
                                    <div class="text-right col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="selectVal">
                                                <option value="all">全部</option>
                                                @foreach($selectVal as $v)
                                                    <option value="{{$v}}" {{$inputs['selectVal']==$v ? 'selected="selected"' : ''}}>
                                                        {{$v}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input name="keyWord" type="text" class="form-control"
                                                   placeholder="请输入..."
                                                   value="{{isset($inputs['keyWord']) ? $inputs['keyWord'] : ''}}">
                                        </div>
                                        <!-- Date -->
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input name="startTime" type="text"
                                                       class="form-control pull-right datepicker"
                                                       value="{{$inputs['startTime']}}">
                                                <div class="input-group-addon">-</div>
                                                <input name="endTime" type="text"
                                                       class="form-control pull-right datepicker"
                                                       value="{{$inputs['endTime']}}">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row table-responsive">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped dataTable">
                                        <thead>
                                        <tr role="row">
                                            @if($showFields)
                                                @foreach($showFields as $field)
                                                    <th>{{$field}}</th>
                                                @endforeach
                                            @endif
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($logs as $log)
                                            <tr>
                                                @if($showFields)
                                                    @foreach($showFields as $field)
                                                        <td>{{isset($log[$field]) ? json_encode($log[$field],JSON_UNESCAPED_UNICODE) : ''}}</td>
                                                    @endforeach
                                                @endif
                                                <td>{{$log['created_at']}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-default"
                                                            onclick="openModal('{{$log['_id']}}')">
                                                        详情
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info">
                                        共 {{$logs->total()}} 记录
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        {{ $logs->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">日志详情</h4>
                </div>
                <div class="modal-body">
                    <pre id="json-renderer"></pre>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('js_footer')
    <script>
        function openModal(id){
            $.post("{{route('log.show')}}",{id:id},function(res){
                console.log(res);
                if(res.status==0){
//                    var data = syntaxHighlight(res.data);
//                    $('#modal-default .modal-body').html('<pre><code>'+ data +'</code></pre>')
                    $('#json-renderer').jsonViewer(res.data);
                }
            },'json')
            $('#modal-default').modal('toggle');
        }
    </script>
@endsection