$(document).ready(function(e) {

	$('#role').on('change',function(){
	   var roles = $(this).val();
         $.ajax({
		    url:'/ajax',
			data:({'a':roles}),
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//токен
			type:'POST',
			datatype:'JSON',
			success: function(html) {
				 swal(html.message);
			
			},
			error:function() {}
							
		});

	})
})