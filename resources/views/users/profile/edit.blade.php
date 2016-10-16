<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">Edit Profile</h4>
</div>
{{ Form::model($userProfile, ['route' => ['profile.update', $userProfile->id], 'id' => 'profileEdit']) }}
<div class="modal-body form-horizontal">

	<div class="form-group">
		{{ csrf_field() }}
		{{ Form::bsInput(
			'email',
			'email',
			'Email Address:'
		) }}
		{{ Form::bsInput(
			'text',
			'firstname',
			'First Name:'
		) }}
		{{ Form::bsInput(
			'text',
			'lastname',
			'Last Name:'
		) }}
		{{ Form::bsInput(
			'select',
			'sex',
			'Sex:',
			[
				'M' => 'Male',
				'F' => 'Female'
			],
			[
				'placeholder' => 'What is your gender?...'
			]
		) }}
		{{ Form::bsInput(
			'select',
			'marital_status',
			'Marital Status:',
			[
				'single' => 'Single',
				'engaged' => 'Engaged',
				'married' => 'Married',
				'divorced' => 'Divorced'
			],
			[
				'placeholder' => 'What is your Marital Status?...'
			]
		) }}
		@if($userProfile->marital_status!='married')
			{{ Form::bsInput(
				'text',
				'spouse_name',
				'Spouse Name:',
				null,
				[
					'display-hide' => true,
				]
			) }}
		@else
			{{ Form::bsInput(
				'text',
				'spouse_name',
				'Spouse Name:',
				null
			) }}
		@endif
		<div class="col-xs-8 col-xs-offset-3">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>

</div>
{{ Form::close() }}
 <script>
$(function(){
	$('#marital_status').on('change',function(e) {
		if($(this).val()=='married'){
			$('#spouse_nameDiv').show();
		} else {
			$('#spouse_nameDiv').hide();
		}

	});
	$('#profileEdit').on('submit',function(e) {
		$.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        })
        e.preventDefault(e);
        $.post("/user/profile/{{$userProfile->id}}", $(this).serialize());
        $('#myModal').modal('hide');
        $('.prayers-section').prepend('<div class="alert alert-success text-center fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Profile Updated!</div>');
	});
});
</script>