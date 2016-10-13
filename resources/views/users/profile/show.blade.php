<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">Profile</h4>
</div>
{{ Form::model($userProfile, ['route' => ['profile.update', $userProfile->id], 'id' => 'profileEdit']) }}
<div class="modal-body form-horizontal">

	<div class="form-group">
		{{ csrf_field() }}
		{{ Form::bsInput('email', 'email', 'Email Address:') }}
		{{ Form::bsInput('text', 'firstname', 'First Name:') }}
		{{ Form::bsInput('text', 'lastname', 'Last Name:') }}
		{{ Form::bsInput('select', 'sex', 'Sex:', ['M' => 'Male', 'F' => 'Female'], ['placeholder' => 'Pick a gender...']) }}
		<div class="col-xs-8 col-xs-offset-3">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>

</div>
{{ Form::close() }}
 <script>
$(function(){
	$('#profileEdit').on('submit',function(e) {
		$.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        })
        e.preventDefault(e);
        $.post("/user/profile/{{$userProfile->id}}", $(this).serialize());
        $('#myModal').modal('hide');
	});
});
</script>