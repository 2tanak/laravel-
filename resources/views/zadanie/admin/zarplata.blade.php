
@if($articles && isset($articles[0]->id))
	
 @if(isset($yvedom))
	 <div class="alert alert-success" role="alert">
 {{ $yvedom }}
 </div>
@endif


	<section>
<div class="main">
@if($articles)
	@foreach($articles as $article)
@if(isset($article))
		<div class="col-sm-12 post">
			<div class="">
				<p class='title'><a href="{{ route('zadanie.edit',array('id'=>$article->id))}}">{{$article->z_name}}</a></p>
				
				<div class='text'>
					 <div class="alert alert-success" role="alert">
					 потвержден менеджером + 10 000</br>
					 программист успешно завершил задачу
					 </div>
				{{mb_substr($article->z_desc , 0, 300, "UTF-8")}}
				<br>
				<p><a href="{{ route('zadanie.edit',array('id'=>$article->id))}}">редактировать
				</div>
				
			</div><!-- /.product -->
		</div>
		@endif
	@endforeach	
	@endif
</div><!-- /.products-row -->
</section>
 @else 
   
<div class="alert alert-success" role="alert">
 у вас нет уведомлений
</div>

   
   
   
   
  
@endif
 



