<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1">
<title>{{$title}}</title>
<link rel="icon" href="favicon.png" type="image/png">

<link href="{{asset('a/style.css')}}" rel="stylesheet" type="text/css"> 

     <!-- [favicon] begin -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(env('THEME')) }}/images/favicon.ico" />
        <link rel="icon" type="image/x-icon" href="{{ asset(env('THEME')) }}/images/favicon.ico" />
        <!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
        <!-- For iPad3 with retina display: -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset(env('THEME')) }}/apple-touch-icon-144x.png" />
        <!-- For first- and second-generation iPad: -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset(env('THEME')) }}/apple-touch-icon-114x.png" />
        <!-- For first- and second-generation iPad: -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset(env('THEME')) }}/apple-touch-icon-72x.png" />
        <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
        <link rel="apple-touch-icon-precomposed" href="{{ asset(env('THEME')) }}/apple-touch-icon-57x.png" />
        <!-- [favicon] end -->
        
        <!-- CSSs -->
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset(env('THEME')) }}/css/reset.css" /> <!-- RESET STYLESHEET -->
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset(env('THEME')) }}/style.css" /> <!-- MAIN THEME STYLESHEET -->
     
      
        
       
 
        <link rel='stylesheet' href='{{ asset(env('THEME')) }}/css/font-awesome.css' type='text/css' media='all' />
            <link rel='stylesheet' href='{{ asset(env('THEME')) }}/css/bootstrap.min.css' type='text/css' media='all' />
		 <link rel='stylesheet' href='{{ asset(env('THEME')) }}/css/style.css' type='text/css' media='all' />
		
	
        <!-- JAVASCRIPTs -->
    
       
		
	 <script type="text/javascript" src="{{ asset(env('THEME')) }}/js/jquery-3.3.1.min.js"></script>
 <script type="text/javascript" src="{{ asset(env('THEME')) }}/js/sriptmy.js"></script>
 
        <script type="text/javascript" src="{{ asset(env('THEME')) }}/js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="{{ asset(env('THEME')) }}/js/bootstrap-filestyle.min.js"></script>
	<script type="text/javascript" src="{{ asset(env('THEME')) }}/js/bootstrap-filestyle.js"></script>
 
		
</head>
<body>

<header id="header_wrapper">
	@yield('header') 
	
	
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
</header>
<div class="site-wrap" style="">
<input type="checkbox" id="nav-trigger" class="nav-trigger" />
<label class='trigger' for="nav-trigger"></label>
	@yield('content')
	@yield('footer')
	</div>



</body>
</html>
