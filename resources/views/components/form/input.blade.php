@if(in_array('display', $attributes))
	<?php $hidediv = " id=" . $name . "Div style=display:none;";?>
@else
	<?php $hidediv = "";?>
@endif
<div class="form-group col-xs-12"{{$hidediv}}>
    	{{ Form::label($name, $label, ['class' => 'col-xs-5 col-sm-3 text-right control-label'], $attributes) }}
    <div class="col-xs-7 col-sm-9">
    	@if($type=='select')
    		{{ Form::$type($name, $value, $default, array_merge(['class' => 'form-control'], $attributes)) }}
    	@else
    		{{ Form::$type($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    	@endif
    </div>
</div>