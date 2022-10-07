{!! Form::model($measureProduct, array('id' => 'product_form','class' => 'form-horizontal', 'method' => $method)) !!}
{!! Form::hidden('measureProduct_id', $measureProduct->id, ['id'=>'measureProduct_id']) !!}
{!! Form::hidden('users_id', $user->id, ['id'=>'users_id']) !!}

<div class="row">
<div class="col-md-6">
        <div class="form-group ">
            {!! Form::label('name','* Nombre:', array('class' => 'control-label col-md-12')) !!}
            <div class="col-md-12">
                {!! Form::text('name', $measureProduct->product ? $measureProduct->product->name : "", array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'name', 'placeholder' => 'ej. Habas', 'maxlength' => '64')) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('measures_id','* Medida:', array('class' => 'control-label  col-md-12')) !!}
            <div class="col-md-12">
                {!! Form::select('measures_id', [''=>'--Seleccione--'] + $measures, $measureProduct->measure ? $measureProduct->measure->id : "", ['class' => 'form-control', 'required'=>'required', 'id'=>'measures_id'] ) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('status','* Estado:', array('class' => 'control-label col-md-12')) !!}
            <div class="col-md-12">
                {!! Form::select('status', array( 'ACTIVE' => 'Activo', 'INACTIVE' => 'Inactivo'),$measureProduct->status,array('class' => 'form-control') ) !!}
            </div>
        </div>
</div>
<div class="col-md-6">
    <div class="form-group ">
            {!! Form::label('stock','* Stock:', array('class' => 'control-label col-md-12')) !!}
            <div class="col-md-12">
                {!! Form::text('stock', $measureProduct->stock , array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'stock', 'placeholder' => 'ej. 8', 'maxlength' => '64')) !!}
            </div>
        </div>
        <div class="form-group ">
            {!! Form::label('price','* Precio:', array('class' => 'control-label col-md-12')) !!}
            <div class="col-md-12">
                {!! Form::text('price',  $measureProduct->precio , array('class' => 'form-control', 'autocomplete' =>
                'off','id'=>'price', 'placeholder' => 'ej. 8', 'maxlength' => '64')) !!}
            </div>
        </div>
</div>
</div>
        
<div class="row"> 
<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('description','* Descripción:', array('class' => 'control-label col-md-12')) !!}
        <div class="col-md-12">
        {!! Form::textarea('description', $measureProduct->product ? $measureProduct->product->description : "", array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'ej. ', 'id'=>'description', 'rows'=> 5)) !!}
        </div>   
    </div>
</div>
</div> 

{!! Form::close() !!}


