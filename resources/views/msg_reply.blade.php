<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href={{ URL::asset('public/AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css') }}>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        
        <link rel="stylesheet" href={{ URL::asset('public/AdminLTE-2.3.11/dist/css/AdminLTE.css') }}>
        <link rel="stylesheet" href={{ URL::asset('public/AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css') }}>

        <script src={{ URL::asset('public/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js') }}></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src={{ URL::asset('public/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js') }}></script>

        <title>detail</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="{{ URL::asset('public/css/custom.css')}}">
        <!-- Styles -->
        
    </head>
    <body>
        
        <form method="post">
          {{ csrf_field() }}
          <div id="wrapper">

            
            <div id="page-wrapper" class="custom-page-wrapper">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <a class="btn btn-warning btn-md" href="{{url('/msg')}}" />回討論區</a><h3></h3>
                </div>
              </div>
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
    </body>
</html>
