@if(in_array('display', $attributes))
	<?php $hidediv = " id=" . $name . "Div style=display:none;";?>
@else
	<?php $hidediv = "";?>
@endif
<div class="form-group"{{$hidediv}}>
    	{{ Form::label($name, $label, ['class' => 'col-xs-3 control-label'], $attributes) }}
    <div class="col-sm-8">
    	@if($type=='select')
    		{{ Form::$type($name, $value, $default, array_merge(['class' => 'form-control'], $attributes)) }}
    	@else
    		{{ Form::$type($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    	@endif
    </div>
</div>