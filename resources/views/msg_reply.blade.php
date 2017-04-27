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

        <script src={{ URL::asset('resources/assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js') }}></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src={{ URL::asset('resources/assets/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js') }}></script>

        <title>detail</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        
    </head>
    <body>
        
        <form method="post">
          {{ csrf_field() }}
          <div id="wrapper">

            
            <div id="page-wrapper" class="custom-page-wrapper">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <a class="btn btn-warning btn-md" href="./" />回討論區</a><h3></h3>
                </div>
              </div>
              <div class="dataTable_wrapper" style="padding-top: 10px">

                  <div class="row">
                    <div class="col-lg-12">
                      @foreach($results as $result)
                        <div class="panel panel-primary">
                          
                          <div class="panel-heading">
                            <tr>
                              {{ $result->REPLY_TIME}}
                            </tr>
                          </div><!-- /.pnel-heading -->
                          
                          <div class="panel-body">
                            <div class="dataTable_wrapper">
                              {{ $result->REPLY_MESSAGE}}
                            </div>
                          </div><!-- /.panel-body -->
                          
                        </div>
                      @endforeach
                      
                    </div><!-- /.col-lg-12 -->
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
                      <input type="submit" name ="SAVE" class="btn btn-warning " value="增"/>
                  </section>
              </div><!-- /#page-wrapper -->
            </div>
          </div>
        </form>

        <script>
            
        </script>
    </body>
</html>
