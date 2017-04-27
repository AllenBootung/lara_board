<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href={{ URL::asset('resources/assets/AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css') }}>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        
        <link rel="stylesheet" href={{ URL::asset('resources/assets/AdminLTE-2.3.11/dist/css/AdminLTE.css') }}>
        <link rel="stylesheet" href={{ URL::asset('resources/assets/AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css') }}>


        <link rel="stylesheet" href="{{ URL::asset('resources/assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.css')}}">
        

        <script src={{ URL::asset('resources/assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js') }}></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src={{ URL::asset('resources/assets/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js') }}></script>
        <script src="{{ URL::asset('resources/assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js')}}"></script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        
    </head>
    <body>
        <form  method="post">
          {{ csrf_field() }}
          <div id="wrapper">

            <!-- Navigation -->
            <div id="page-wrapper" class="col-md-12">

              <div class="dataTable_wrapper">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-primary">
                      <div class="panel-heading" style="text-align: center;">
                        <tr style="display: inline;">
                          討論區
                        </tr>
                      </div><!-- /.panel-heading -->
                      <div class="panel-body">
                        <div class="dataTable_wrapper">
                          <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                            <thead>
                              <tr class="bg-blue"> 
                                  
                                  <th>開始時間</th>
                                  <th width="40%">議題</th>
                                  <th>回應數</th>
                                  <th>結束時間</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                  <tr>

                                    <td>{{$result->MSG_TIME}}</td>
                                    <td><a href="msg/{{$result->MSG_NO}}">{{$result->MSG_TITLE}}</a></td>
                                    <td>{{$result->REPLY_COUNT}}</td>
                                    
                                    <td>{{$result->REPLY_TIME}}</td>
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                  </div><!-- /.col-lg-12 -->
                </div>
              
            </div><!-- /#page-wrapper -->

          </div><!-- /#wrapper -->

        </form>

        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true,
                        "language": {
                        
                                        "sProcessing":   "處理中...",
                                        "sLengthMenu":   "顯示 _MENU_ 項結果",
                                        "sZeroRecords":  " ",
                                        "sInfo":         "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
                                        "sInfoEmpty":    "顯示第 0 至 0 項結果，共 0 項",
                                        "sInfoFiltered": "(從 _MAX_ 項結果過濾)",
                                        "sInfoPostFix":  "",
                                        "sSearch":       "搜索:",
                                        "sUrl":          "",
                                        "oPaginate": {
                                            "sFirst":    "首頁",
                                            "sPrevious": "上頁",
                                            "sNext":     "下頁",
                                            "sLast":     "尾頁"
                                        }
                                    }
                        
                });

                $('#dataTables-example_length').append(
                  '<a class="btn btn-warning btn-sm" id="btn_add" href="./msg/add">增</a>'

                );//$('#dataTables-example_length').append(
            });
        </script>
    </body>
</html>
