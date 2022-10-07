{!! Form::model($measure, array('id' => 'measure_form','class' => 'form-horizontal', 'method' => $method)) !!}
{!! Form::hidden('measure_id', $measure->id,['id'=>'measure_id']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('measure','* Medida:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('measure', $measure->measure, array('class' => 'form-control', 'autocomplete' =>
                'off', 'placeholder' => 'ej. Operador', 'maxlength' => '64')) !!}
            </div>
        </div>

        <div class="form-group">
        {!! Form::label('status','* Estado:', array('class' => 'control-label col-md-3')) !!}
        <div class="col-md-12">
            {!! Form::select('status', array( 'ACTIVE' => 'Activo', 'INACTIVE' => 'Inactivo'),$measure->status,array('class' => 'form-control') ) !!}
        </div>
    </div>
    </div> 

</div>

{!! Form::close() !!}