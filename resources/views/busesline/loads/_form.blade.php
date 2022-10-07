{!! Form::model($busesLine, array('id' => 'news_form','class' => 'form-horizontal', 'method' => $method)) !!}
{!! Form::hidden('busesLine_id', $busesLine->id,['id'=>'busesLine_id']) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name','* Titulo:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('name', $busesLine->name, array('class' => 'form-control', 'autocomplete' =>
                'off', 'placeholder' => 'ej. Ida al mercado', 'maxlength' => '64')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('lng_init','* Longitud punto de inicio:', array('class' => 'control-label col-md-3')) !!}
            <div class="col-md-12">
                {!! Form::text('lng_init', $busesLine->lng_init, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'lng_init', 'placeholder' => 'ej. 89.1543', 'maxlength' => '100')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('lat_init','* Latitud punto de inicio:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('lat_init', $busesLine->lat_init, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'lat_init', 'placeholder' => 'ej. 89.15', 'maxlength' => '100')) !!}
            </div>
        </div>
        <div class="form-group">
        {!! Form::label('status','* Estado:', array('class' => 'control-label col-md-3')) !!}
        <div class="col-md-12">
            {!! Form::select('status', array( 'ACTIVE' => 'Activo', 'INACTIVE' => 'Inactivo'),$news->status,array('class' => 'form-control') ) !!}
        </div>
    </div>
                </div>
    <div class="col-md-6">
    <div class="form-group">
            {!! Form::label('lng_finish','* Longitud punto de llegada:', array('class' => 'control-label col-md-3')) !!}
            <div class="col-md-12">
                {!! Form::text('lng_finish', $busesLine->lng_finish, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'lng_finish', 'placeholder' => 'ej. 89.1543', 'maxlength' => '100')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('lat_finish','* Latitud punto de llegada:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('lat_finish', $busesLine->lat_finish, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'lat_finish', 'placeholder' => 'ej. 89.15', 'maxlength' => '100')) !!}
            </div>
        </div>

    <div class="form-group">
    {!! Form::label('description','* Descripción:', array('class' => 'control-label')) !!}
    {!! Form::textarea('description', $busesLine->description, array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'ej. ', 'id'=>'description', 'rows'=> 3)) !!}
</div>
<div class="form-group">
            {!! Form::label('price','* Precio:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('price', $busesLine->date, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'price', 'placeholder' => 'ej. 89.15')) !!}
            </div>
        </div>

    </div>
    </div> 

</div>

{!! Form::close() !!}