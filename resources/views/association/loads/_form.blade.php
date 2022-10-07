{!! Form::model($association, array('id' => 'association_form','class' => 'form-horizontal', 'method' => $method)) !!}
{!! Form::hidden('association_id', $association->id,['id'=>'association_id']) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name','* Nombre:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('name', $association->name, array('class' => 'form-control', 'autocomplete' =>
                'off', 'placeholder' => 'ej. Operador', 'maxlength' => '64')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('name','* Latitud:', array('class' => 'control-label col-md-3')) !!}
            <div class="col-md-12">
                {!! Form::text('lat', $association->lat, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'email', 'placeholder' => 'ej. 89.15', 'maxlength' => '100')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('name','* Longitud:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('lng', $association->lng, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'email', 'placeholder' => 'ej. 89.15', 'maxlength' => '100')) !!}
            </div>
        </div>
        <div class="form-group">
        {!! Form::label('status','* Estado:', array('class' => 'control-label col-md-3')) !!}
        <div class="col-md-12">
            {!! Form::select('status', array( 'ACTIVE' => 'Activo', 'INACTIVE' => 'Inactivo'),$association->status,array('class' => 'form-control') ) !!}
        </div>
    </div>
                </div>
    <div class="col-md-6">
    <div class="form-group">
    {!! Form::label('users_id','* Usuario:', array('class' => 'control-label')) !!}
    
        {!! Form::select('users_id', [''=>'Seleccione']+$users, $association->users_id, array('class' => 'form-control', 'autocomplete' =>
        'off','id'=>'users_id','required')) !!}
</div>
    <div class="form-group">
    {!! Form::label('advantages','* Ventajas:', array('class' => 'control-label')) !!}
    {!! Form::textarea('advantages', $association->advantages, array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'ej. ', 'id'=>'advantages', 'rows'=> 3)) !!}
</div>
<div class="form-group">
    {!! Form::label('rules','* Reglas:', array('class' => 'control-label')) !!}
    {!! Form::textarea('rules', $association->rules, array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'ej. ', 'id'=>'rules', 'rows'=> 3)) !!}
</div>
    </div>
    </div> 

</div>

{!! Form::close() !!}