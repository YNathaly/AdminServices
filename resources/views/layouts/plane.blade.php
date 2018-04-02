<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>Administrador</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/jquery.steps.css')}}" rel="stylesheet">
	<link href="{{ asset('css/template.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('assets/stylesheets/styles.css') }}" />
    <link href="{{ asset('css/bootstrap-reset.css') }}" rel="stylesheet">

    <!--external css-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->


</head>
<body>
	@yield('body')
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset("js/jquery.js") }}" type="text/javascript"></script>
	<script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/common-scripts.js")}}" type="text/javascript"></script>
	<script src="{{ asset("js/jquery.dcjqaccordion.2.7.js")}}" type="text/javascript"></script>
	<script src="{{ asset("js/jquery.scrollTo.min.js")}}" type="text/javascript"></script>
	<script src="{{ asset("js/respond.min.js")}}" type="text/javascript"></script>
</body>
</html>