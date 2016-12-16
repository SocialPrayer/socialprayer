<div class="modal-header" style="border-bottom: 0;">
	<button data-dismiss="modal" class="close" aria-label="Close" class="btn btn-default">Close &times;</button>
	<h3 class="modal-title text-center">Your Profile</h3>
	<ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active">
	    	<a href="#home" aria-controls="home" role="tab" data-toggle="tab">
	    		Personal Info
	    	</a>
	    </li>
	    <li role="presentation">
	    	<a href="#friends" aria-controls="friends" role="tab" data-toggle="tab">
	    		Friends
	    	</a>
	    </li>
	    <!--<li role="presentation">
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
		<div class="row">
			@forelse ($userProfile->user->friends as $friend)
				<div class="panel panel-default col-xs-10 col-xs-offset-1">
	                <div class="panel-body clearfix">
	                	<div class="row vcenter">
		                	<div class="col-xs-10">
		                		<h4>
		                			{{ $friend->name }}
		                			<small> - <a href="#" class="view-prayers" data-id="{{ $friend->id }}">View Prayers</a></small>
		                		</h4>
		                		<p class="small text-muted">
		                			Friends Since: 
		                			{{ $friend->created_at->toFormattedDateString() }}
		                		</p>
		                	</div>
		                	<div class="col-xs-2 text-right">
			                	<button class="unfriend btn btn-large btn-default" data-toggle="tooltip" data-placement="bottom" title="Remove Friend" data-id="{{ $friend->id }}">
			                		<span class="glyphicon glyphicon-remove-circle"></span>
			                	</button>
			                </div>
		                </div>
	                </div>
	            </div>
	        @empty
	        	<div class="text-center bottom-buffer">
	        		<h3>You do not have any friends yet.</h3>
	        	</div>
	        @endforelse
		</div>
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

	$('.view-prayers').on('click',function(e) {
		var userid = $(this).data('id');
		parent.window.location = '/prayers/user/' + userid;
	});

	$('.unfriend').on('click',function(e) {
		var friendid = $(this).data('id');
		$row = $(this).parents('.panel');
		$.get('/user/removefriend/' + friendid, function () {
			$row.remove();
		});
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