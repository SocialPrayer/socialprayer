<div class="form-group">
    	{{ Form::label($name, $label, ['class' => 'col-xs-3 control-label']) }}
    <div class="col-sm-8">
    	@if($type=='select')
    		{{ Form::$type($name, $value, $default, array_merge(['class' => 'form-control'], $attributes)) }}
    	@else
    		{{ Form::$type($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    	@endif
    </div>
</div>