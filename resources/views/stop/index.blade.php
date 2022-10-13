@section('content')
<div class="bg-white " style="margin-top: 0px ; text-align: center; width: 1050px ; align-self: center;">
    
      <br> 
      <div class="d-flex flex-column mb-10 mb-md-0">
    <label style="text-aling: center"><b>Información de la Línea de Bus</b> </label><br>
   <span><label><b>Nombre :</b> </label>
    <label>{{$busesLine->name}} </label></span>
    <span><label><b>Precio :</b> </label>
    <label>{{$busesLine->price}} </label></span>
    <span><label><b>Estado :</b> </label>
      @if ($busesLine->status == 'ACTIVE')
      <label> Activo</label></span>
      @else
      <label>Inactivo </label></span>
      @endif
      </div> </div> 
    
  <br><br><br>
    @include('stop.table_stop_view',[
    'title'=>'Administración de paradas',
    'icon'=>'<i class="flaticon-cogwheel-2"></i>',
    'id_table'=>'stop_table',
    'action_buttons'=>[
        [
        'label'=>'Crear Paradas',
        'icon'=>'<i class="la la-plus"></i>',
        'handler_js'=>'newStop()',
        'color'=>'btn-primary'
        ],
      ]
    ])
    @include('partials.modal',[
    'title'=>'Crear Parada',
    'id'=>'stop_modal',
    'size'=>'modal-lg',
    'action_buttons'=>[
        [
        'type'=>'submit',
        'form'=>'stop_form',
        'id'=>'btn_save',
        'label'=>'Guardar',
        'color'=>'btn-primary'
        ],
     ]
    ])

    <input id="action_get_form_stop" type="hidden" value="{{ route("getFormStop", $busesLine->id) }}"/>
    <input id="action_save_stop" type="hidden" value="{{ route("saveStop") }}"/>
    <input id="action_load_stops" type="hidden" value="{{ route("getListDataStop", $busesLine->id) }}"/>
@endsection
@section('additional-scripts')
    <script src="{{asset("js/app/stop/index.js")}}"></script>
@endsection