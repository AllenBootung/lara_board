@extends('template')
@section('content')
      <form  method="post">
        {{ csrf_field() }}
        <div id="wrapper">

          <div id="page-wrapper" class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading" style="text-align: center;">
                  <tr style="display: inline;">
                    討論區
                  </tr>
                </div>
                <div class="panel-body">
                    <table class="table" style="margin:0 auto;">
                        
                        <tr class="bg-blue"> 
                          <th style='width:8%'>功能</th>
                          <th>開始時間</th>
                          <th>議題</th>
                          <th style='width:15%'>摘要</th>
                          <th>回應數</th>
                          <th>結束時間</th>
                        </tr>
                     
                      <tbody>
                        @foreach($results as $result)
                          <tr>
                            <input type="hidden" id="MSG_NO" name="MSG_NO" value="{{$result->MSG_NO}}">
                            <td>
                                <input type="button" class="btn btn-success btn-xs btn_edit" value="編">
                                <input type="button" class="btn btn-danger btn-xs btn_del" value="刪">
                            </td>
                            <td>{{$result->created_at}}</td>
                            <td class="align-left cut-td" id="MSG_TITLE" style="overflow:hidden;"><a href="msg/{{$result->MSG_NO}}">{{$result->MSG_TITLE}}</a></td>
                            <td class="align-left cut-td" style="max-width:150px">{{$result->FIRST_MESSAGE}}</td>
                            <td>{{$result->REPLY_COUNT}}</td>
                            <td>{{$result->reply_created_at}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  
                </div><!-- /.panel-body -->
              </div><!-- /.panel -->
                              
              {{ $results->links() }}
          </div><!-- /#page-wrapper -->

        </div><!-- /#wrapper -->

      </form>
      <script type="text/javascript">
        $(".btn_edit").click(function(){
          $("#wrapper").find("input").attr("disabled","true");
          $(this).parent().siblings("#MSG_NO").removeAttr("disabled");

          $(this).parent().siblings("#MSG_TITLE").html(
            '<input class="form-contrl mustfill" name="MSG_TITLE" value="'+
              $(this).parent().siblings("#MSG_TITLE").children("a").html()+
            '"/>'
          );
          $(this).parent().html(
            '<input type="submit" class="btn btn-danger btn-xs" name="SAVE_EDIT" value="存" onclick="return all_check();"/>'+
            '<input type="button" class="btn btn-default btn-xs" value="消" onclick="window.location.href = window.location.pathname + window.location.search;"/>'
          );

        });

        function all_check()
        {
            all_fill = true;
            $(".mustfill").each(function(){
              if ($(this).val()==""){
                all_fill = false;
                $(this).addClass("not_fill");
                
              } else {
                $(this).removeClass("not_fill");
              }
            });
            
            return all_fill;
            
        }//function all_check()
      </script>
      <script type="text/javascript">
        $(".btn_del").click(function(){
            $("#wrapper").find("input").attr("disabled","true");
            $(this).parent().siblings("#MSG_NO").removeAttr("disabled");

            $(this).parent().html(
              '<input type="button" class="btn btn-default btn-xs" value="消" onclick="window.location.href = window.location.pathname + window.location.search;"/>'+
              '<input type="submit" class="btn btn-danger btn-xs" id="btn_delee_submit" name="DEL_LIST" value="是"/>'
            );
            
          });//$("#btn_delete").click(function()
      </script>
      
@stop