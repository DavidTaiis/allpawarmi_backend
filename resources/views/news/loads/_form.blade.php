{!! Form::model($news, array('id' => 'news_form','class' => 'form-horizontal', 'method' => $method)) !!}
{!! Form::hidden('news_id', $news->id,['id'=>'news_id']) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title','* Titulo:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('title', $news->title, array('class' => 'form-control', 'autocomplete' =>
                'off', 'placeholder' => 'ej. Via cerrada', 'maxlength' => '64')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('lng','* Longitud:', array('class' => 'control-label col-md-3')) !!}
            <div class="col-md-12">
                {!! Form::text('lng', $news->lng, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'lng', 'placeholder' => 'ej. 89.15', 'maxlength' => '100')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('lat','* Latitud:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::text('lat', $news->lat, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'lat', 'placeholder' => 'ej. 89.15', 'maxlength' => '100')) !!}
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
    {!! Form::label('description','* Descripción:', array('class' => 'control-label')) !!}
    {!! Form::textarea('description', $news->description, array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'ej. ', 'id'=>'description', 'rows'=> 3)) !!}
</div>
<div class="form-group">
            {!! Form::label('date','* Fecha:', array('class' => 'control-label col-md-6')) !!}
            <div class="col-md-12">
                {!! Form::date('date', $news->date, array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'date', 'placeholder' => 'ej. 89.15')) !!}
            </div>
        </div>

    </div>
    </div> 

</div>

{!! Form::close() !!}