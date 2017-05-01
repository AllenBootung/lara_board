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
    .panel-body {
      padding: 0;
    }
  </style>
</head>
<body>
	<div class="header">
	</div>
	<div class="content">
		@yield('content')
	</div>

</body>
</html>