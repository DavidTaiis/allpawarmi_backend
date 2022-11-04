{!! Form::model($comercio, array('id' => 'comercio_form','class' => 'form-horizontal', 'method' => $method)) !!}
{!! Form::hidden('comercio_id', $comercio->id,['id'=>'comercio_id']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('name','* Nombre:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('name', $comercio->name, array('class' => 'form-control', 'autocomplete' =>
                'off', 'placeholder' => 'ej. Comercio', 'maxlength' => '64')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('lat','* Latitud:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('lat', $comercio->lat, array('class' => 'form-control', 'autocomplete' =>
                'off', 'placeholder' => 'ej. -0.10000566', 'maxlength' => '64')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('lng','* Longitud:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('lng', $comercio->lng, array('class' => 'form-control', 'autocomplete' =>
                'off', 'placeholder' => 'ej. 78.054855', 'maxlength' => '64')) !!}
            </div>
        </div>

        <div class="form-group">
        {!! Form::label('status','* Estado:', array('class' => 'control-label col-md-3')) !!}
        <div class="col-md-12">
            {!! Form::select('status', array( 'ACTIVE' => 'Activo', 'INACTIVE' => 'Inactivo'),$comercio->status,array('class' => 'form-control') ) !!}
        </div>
    </div>
    <div class="form-group">
            {!! Form::label('description','* Descripción:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::textarea('description', $comercio->description, array('class' => 'form-control', 'autocomplete' =>
                'off', 'placeholder' => '', 'rows'=> 3)) !!}
            </div>
        </div>
    </div> 

</div>

{!! Form::close() !!}