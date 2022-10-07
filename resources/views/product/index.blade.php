@section('content')
<div class="bg-white " style="margin-top: 0px ; text-align: center; width: 1220px ; align-self: center;">
    
      <br> 
      <div class="d-flex flex-column mb-10 mb-md-0">
    <label style="text-aling: center"><b>Información del Agricultor</b> </label><br>
   <span><label><b>Nombre :</b> </label>
    <label>{{$farmer->name}} </label></span>
    <span><label><b>Teléfono :</b> </label>
    <label>{{$farmer->phone_number}} </label></span>
    <span><label><b>Estado :</b> </label>
      @if ($farmer->status == 'ACTIVE')
      <label> Activo</label></span>
      @else
      <label>Inactivo </label></span>
      @endif
      </div> </div> 
    
  <br><br><br>
    @include('product.table_product_view',[
    'title'=>'Administración de productos',
    'icon'=>'<i class="flaticon-cogwheel-2"></i>',
    'id_table'=>'product_table',
    'action_buttons'=>[
        [
        'label'=>'Crear Producto',
        'icon'=>'<i class="la la-plus"></i>',
        'handler_js'=>'newProduct()',
        'color'=>'btn-primary'
        ],
      ]
    ])
    @include('partials.modal',[
    'title'=>'Crear Product',
    'id'=>'product_modal',
    'size'=>'modal-lg',
    'action_buttons'=>[
        [
        'type'=>'submit',
        'form'=>'product_form',
        'id'=>'btn_save',
        'label'=>'Guardar',
        'color'=>'btn-primary'
        ],
     ]
    ])

    <input id="action_get_form_product" type="hidden" value="{{ route("getFormProduct", $farmer->id) }}"/>
    <input id="action_save_product" type="hidden" value="{{ route("saveProduct") }}"/>
    <input id="action_load_products" type="hidden" value="{{ route("getListDataProduct", $farmer->id) }}"/>
    <input id="action_update_weight_product" type="hidden" value="{{ route("updateProductWeight") }}"/>
@endsection
@section('additional-scripts')
    <script src="{{asset("js/app/product/index.js")}}"></script>
@endsection