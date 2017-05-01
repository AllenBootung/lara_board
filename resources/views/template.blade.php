<!DOCTYPE html>
<html lang="en">
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
 

  <title>Laravel</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  
  <link rel="stylesheet" href="{{ URL::asset('public/css/custom.css')}}">
  <!-- Styles -->
  <style type="text/css">
    .affix {
          top: 0;
          width: 100%;
      }

    .affix + .container-fluid {
        padding-top: 70px;
    }
    .panel-body {
      padding: 0;
    }
  </style>
</head>
<body>
	<div class="header">
    <div class="container-fluid" style="background-color:#F44336;color:#fff;">
      <h1>Laravel msg board</h1>
      
    </div>

    <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="150" style="background: rgba(1,1,1,0.75);">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/msg')}}">討論區</a></li>
        <li><a href="{{url('/msg/add')}}">發新主題</a></li>
        
      </ul>
    </nav>
	</div>
	<div class="content">
		@yield('content')
	</div>

</body>
</html>