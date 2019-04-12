<h3 style='text-align:center;font-size:30px'>Создание задания</h3>
{!! Form::open(['url' => (isset($article->id)) ? route('zadanie.update',['zadanie'=>$article->id]) : 
route('zadanie.store'),'class'=>'contact-form','method'=>'POST']) !!}
	
<div class="form-group">
    <label>Название задачи:</label>
    {!! Form::text('z_name',isset($article->z_name) ? $article->z_name  : old('name'), ['placeholder'=>'Введите название задачи','class'=>'form-control','required autofocus']) !!}
</div>
  
<div class="form-group">
    <label for="email">сроки работы:</label>
  {!! Form::text('z_srok',isset($article->z_srok ) ? $article->z_srok   : old('z_srok'), ['placeholder'=>'срок работы выставляется менеджером','id'=>'datepicker','class'=>'form-control','required autofocus']) !!}
</div>
	
<div class="form-group">
    <label for="email">сроки завершение работы:</label>
{!! Form::text('time_prog',isset($article->time_prog ) ? $article->time_prog   : old('time_prog'), ['placeholder'=>'срок завершения, выставляется программистом','id'=>'datepicker2','class'=>'form-control']) !!}
</div>	

 <div class="form-group">
    <label>Краткое описание:</label>
{!! Form::textarea('z_desc', isset($article->z_desc ) ? $article->z_desc    : old('z_desc'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите описание задачи','required autofocus']) !!}
</div>
{{ csrf_field() }}

<div class="form-group">
    <label>Статус:</label>
{!! Form::select('status', ['1'=>'новая задача','2'=>'на исполнении','3'=>'выполнена','4'=>'закрыта'],isset($article->status) ? $article->status: '',['class'=>'form-control']) !!}
</div>
	
<div class="form-group">
    <label>Тип задачи:</label>
		{!! Form::select('tip', ['1'=>'фича','2'=>'поддержка','3'=>'ошибка'],isset($article->tip) ? $article->tip: '',['class'=>'form-control']) !!}
</div>
		
<div class="form-group">
    <label>выбрать менеджера либо программиста:</label>
			{!! Form::select('prava', ['0'=>'выбрать роль пользователя','MANAGER'=>'менеджер','PROGER'=>'программист'], isset($role) ? $role: 0,['class'=>'form-control','id'=>'role']) !!}
</div>
	
		
{!! Form::hidden('id_user',isset($user_id) ? $user_id : $article->id_user) !!}

@if(isset($article->id))
			{!! Form::hidden('id',$article->id) !!}
<input type="hidden" name="_method" value="PUT">		
		@endif
<div class="form-group">
			{!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}			
		</div>
		
		
		 
		 
	
	
	
{!! Form::close() !!}	


<div class="form-group">
@if(isset($article->id))
	{!! Form::open(['url' => route('zadanie.destroy',['articles'=>$article->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
												{!! Form::close() !!}
@endif
</div>





