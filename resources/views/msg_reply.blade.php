@extends('template')
@section('content')

        <form method="post">
          {{ csrf_field() }}
          <div id="wrapper">

            
            <div id="page-wrapper" class="custom-page-wrapper">
              
              <div class="dataTable_wrapper" style="padding-top: 10px">

                  <div class="row">                    
                      @foreach($results as $result)
                        <div class="panel panel-primary">
                          <input type="hidden" id="REPLY_NO" name="REPLY_NO" value="{{$result->REPLY_NO}}">
                          <div class="panel-heading">
                              <input type="button" class="btn btn-success btn-xs btn_edit" value="編">
                              <input type="button" class="btn btn-danger btn-xs btn_del" value="刪">
                              {{ $result->REPLY_TIME}}
                          </div><!-- /.pnel-heading -->
                          
                          <div class="panel-body" id="REPLY_MESSAGE">
                            
                              {{ $result->REPLY_MESSAGE}}
                            
                          </div><!-- /.panel-body -->
                          
                        </div>
                      @endforeach                                         
                  </div><!-- /.row -->

                  @if ( isset($add_title) )
                    <input type="text" class="form-control" name="MSG_TITLE">
                  @endif
                  
                  <section class="row" style="margin-top:10px;">
                      <div class="panel panel-primary">
                        <div class="panel-heading">
                          <textarea class="form-control" rows="11" name="REPLY_MESSAGE"></textarea>
                        </div>
                      </div><!-- /.panel -->
                      <input type="submit" name ="SAVE_ADD" class="btn btn-warning " value="增"/>
                  </section>
              </div><!-- /#page-wrapper -->
            </div>
          </div>
        </form>

        <script type="text/javascript">
          $(".btn_edit").click(function(){
            $("#wrapper").find("input").attr("disabled","true");
            $(this).parent().siblings("#REPLY_NO").removeAttr("disabled");

            $(this).parent().siblings("#REPLY_MESSAGE").html(
              '<textarea class="form-control mustfill" name="REPLY_MESSAGE">'+
                $(this).parent().siblings("#REPLY_MESSAGE").html()+
              '</textarea>'
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
              $(this).parent().siblings("#REPLY_NO").removeAttr("disabled");

              $(this).parent().html(
                '<input type="button" class="btn btn-default btn-xs" value="消" onclick="window.location.href = window.location.pathname + window.location.search;"/>'+
                '<input type="submit" class="btn btn-danger btn-xs" id="btn_delee_submit" name="DEL_LIST" value="是"/>'
              );
              
            });//$("#btn_delete").click(function()
        </script>
@stop