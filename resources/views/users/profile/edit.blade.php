<div class="modal-header" style="border-bottom: 0;">
	<button data-dismiss="modal" class="close" aria-label="Close" class="btn btn-default">Close &times;</button>
	<h3 class="modal-title text-center">Your Profile</h3>
	<ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active">
	    	<a href="#home" aria-controls="home" role="tab" data-toggle="tab">
	    		Personal Info
	    	</a>
	    </li>
	    <!-- <li role="presentation">
	    	<a href="#friends" aria-controls="friends" role="tab" data-toggle="tab">
	    		Friends
	    	</a>
	    </li>
	    <li role="presentation">
	    	<a href="#alerts" aria-controls="alerts" role="tab" data-toggle="tab">
	    		Alerts
	    	</a>
	    </li>
	    <li role="presentation">
	    	<a href="#picture" aria-controls="picture" role="tab" data-toggle="tab">
	    		Profile Picture
	    	</a>
	    </li>
	    <li role="presentation">
	    	<a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">
	    		Stats
	    	</a>
	    </li> -->
	</ul>
</div>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active form-horizontal" id="home">
		{{ Form::model($userProfile, ['route' => ['profile.update', $userProfile->id], 'id' => 'profileEdit']) }}
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
			<div class="text-center">

				<button type="submit" class="btn btn-lg btn-primary">Submit</button>
			</div>
		</div>
		{{ Form::close() }}
	</div>
	<div role="tabpanel" class="tab-pane" id="friends">
		<!--Friends go here -->
	</div>
	<div role="tabpanel" class="tab-pane" id="alerts">
		<!--Friends go here -->
	</div>
	<div role="tabpanel" class="tab-pane" id="picture">
		<!--Friends go here -->
	</div>
	<div role="tabpanel" class="tab-pane" id="stats">
		<!--Friends go here -->
	</div>
</div>
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