{!! Form::model($stop, array('id' => 'stop_form','class' => 'form-horizontal', 'method' => $method)) !!}
{!! Form::hidden('stop_id', $stop->id, ['id'=>'stop_id']) !!}
{!! Form::hidden('busesLine_id', $busesLine->id, ['id'=>'busesLine_id']) !!}

<div class="row">
<div class="col-md-6">
        <div class="form-group ">
            {!! Form::label('name','* Nombre:', array('class' => 'control-label col-md-12')) !!}
            <div class="col-md-12">
                {!! Form::text('name', $stop->name, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'name', 'placeholder' => 'ej. Parada 1', 'maxlength' => '64')) !!}
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('status','* Estado:', array('class' => 'control-label col-md-12')) !!}
            <div class="col-md-12">
                {!! Form::select('status', array( 'ACTIVE' => 'Activo', 'INACTIVE' => 'Inactivo'),$stop->status,array('class' => 'form-control') ) !!}
            </div>
        </div>
</div>
<div class="col-md-6">
<div class="form-group">
            {!! Form::label('lng','* Longitud:', array('class' => 'control-label col-md-12')) !!}
            <div class="col-md-12">
                {!! Form::text('lng', $stop->geolocation ? $stop->geolocation->lng : "", array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'lng', 'placeholder' => 'ej. 89.1543', 'maxlength' => '100')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('lat','* Latitud:', array('class' => 'control-label col-md-12')) !!}
            <div class="col-md-12">
                {!! Form::text('lat',$stop->geolocation ? $stop->geolocation->lat : "", array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'lat', 'placeholder' => 'ej. 89.15', 'maxlength' => '100')) !!}
            </div>
        </div>
</div>
</div>
        
<div class="row"> 
<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('description','* Descripción:', array('class' => 'control-label col-md-12')) !!}
        <div class="col-md-12">
        {!! Form::textarea('description', $stop->description, array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'ej. ', 'id'=>'description', 'rows'=> 5)) !!}
        </div>   
    </div>
</div>
</div> 

{!! Form::close() !!}


