<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Главная</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
    
	 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	 <link href="{{ asset('css/data/jquery-ui.css') }}" rel="stylesheet">
	  <link href="{{ asset('css/data/jquery-ui.css') }}" rel="stylesheet">
	 <link rel="stylesheet" href="/css/style.css">
	 <link rel="stylesheet" href="/css/bootstrap.min.css">
	 
	 
	 
	<script type="text/javascript" src="{{ asset(env('THEME')) }}/js/ckeditor/ckeditor.js"></script>
        
</head>
<body>
<header>
    <div class="container">
          <div id="app">
  @if (count($errors) > 0)
    <div class="alert alert-danger" style='text-align:center'>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" style='text-align:center'>
        {{ session('error') }}
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('message'))
    <div class="alert alert-success" style='text-align:center'>
        {{ session('message') }}
    </div>
@endif


        
    </div>
    
    </div>
	
	
	
	
</header>

	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
   

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active">
		  <a href="/">главная <span class="sr-only">(current)</span></a>
		    </li>
        <li><a href="/admin">админка</a>
		</li>
		@if(Auth::check())
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">задания <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/spisoc">список заданий</a></li>
            <li><a href="/admin">добавить задание</a></li>
			
          </ul>
        </li>
		
		  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">уведомления <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{route('yvedom')}}">новые задачи</a></li>
             <li><a href="{{route('vrabote')}}">выполняются</a></li>
			 <li><a href="{{route('zarplata')}}">успешные задания</a></li>
			 <li><a href="{{route('zarplata2')}}">не успешные задания</a></li>
          </ul>
        </li>
		@endif
		@if(Auth::check())
	<li><a href="/logout">выход</a></li>
		@endif
      </ul>
   
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="clear"></div>



