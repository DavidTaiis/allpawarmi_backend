{!! Form::model($acopio, array('id' => 'acopio_form','class' => 'form-horizontal', 'method' => $method)) !!}
{!! Form::hidden('acopio_id', $acopio->id,['id'=>'acopio_id']) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name','* Nombre:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('name', $acopio->name, array('class' => 'form-control', 'autocomplete' =>
                'off', 'placeholder' => 'ej. Operador', 'maxlength' => '64')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('name','* Latitud:', array('class' => 'control-label col-md-3')) !!}
            <div class="col-md-12">
                {!! Form::text('lat', $acopio->lat, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'email', 'placeholder' => 'ej. 89.15', 'maxlength' => '100')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('name','* Longitud:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('lng', $acopio->lng, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'email', 'placeholder' => 'ej. 89.15', 'maxlength' => '100')) !!}
            </div>
        </div>
        <div class="form-group">
        {!! Form::label('status','* Estado:', array('class' => 'control-label col-md-3')) !!}
        <div class="col-md-12">
            {!! Form::select('status', array( 'ACTIVE' => 'Activo', 'INACTIVE' => 'Inactivo'),$acopio->status,array('class' => 'form-control') ) !!}
        </div>
    </div>
                </div>
    <div class="col-md-6">
    <div class="form-group">
    {!! Form::label('users_id','* Usuario:', array('class' => 'control-label')) !!}
    
        {!! Form::select('users_id', [''=>'Seleccione']+$users, $acopio->users_id, array('class' => 'form-control', 'autocomplete' =>
        'off','id'=>'users_id','required')) !!}
</div>
    <div class="form-group">
    {!! Form::label('description','* Descripción:', array('class' => 'control-label')) !!}
    {!! Form::textarea('description', $acopio->description, array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'ej. ', 'id'=>'advantages', 'rows'=> 3)) !!}
</div>
<div class="form-group">
    {!! Form::label('days','* Días:', array('class' => 'control-label')) !!}
        {!! Form::select('days[]',["Lunes"=>"Lunes", "Martes"=>"Martes", "Miércoles"=>"Miércoles", "Jueves"=>"Jueves", "Viernes"=>"Viernes", "Sábado"=>"Sábado", "Domingo"=>"Domingo"], $acopio->days, array('class' => 'form-control', 'autocomplete' =>
        'off','id'=>'days','required')) !!}
</div>
<div class="form-group">
            {!! Form::label('hours','* Horas:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('hours', $acopio->hours, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'hours', 'placeholder' => 'ej. 15:00 PM', 'maxlength' => '100')) !!}
            </div>
        </div>

    </div>
    </div> 

</div>

{!! Form::close() !!}