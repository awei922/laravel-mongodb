@extends('layouts/main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            警报记录
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i>控制台</a></li>
            <li class="active">警报记录</li>
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
                                    <a class="btn btn-info" href="{{route('config.alertConfig')}}">配置</a>
                                </div>
                                <form action="" role="form">
                                    <div class="text-right col-sm-10">
                                        <div class="form-group">
                                            <select class="form-control" name="selectVal">
                                                <option value="all">全部</option>
                                                @foreach($selectVal as $k=>$v)
                                                    <option value="{{$k}}" {{$inputs['selectVal']==$k ? 'selected="selected"' : ''}}>
                                                        {{$v}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input name="keyWord" type="text" class="form-control"
                                                   placeholder="{{isset($inputs['keyWord']) ? $inputs['keyWord'] : '请输入...'}}"
                                                   value="">
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
                                            <th>To</th>
                                            <th>Content</th>
                                            <th>Failures</th>
                                            <th>创建时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($alerts as $alert)
                                            <tr>
                                                <td>{{isset($alert['to']) ? $alert['to'] : ''}}</td>
                                                <td>{{isset($alert['content']) ? $alert['content'] : ''}}</td>
                                                <td>{{isset($alert['failures']) ? json_encode($alert['failures'],JSON_UNESCAPED_UNICODE) : ''}}</td>
                                                <td>{{$alert['created_at']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info">
                                        共 {{$alerts->total()}} 记录
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        {{ $alerts->links() }}
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