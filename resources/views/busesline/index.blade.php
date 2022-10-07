@section('content')
    @include('partials.admin_view',[
    'title'=>'Administración de Lineas de buses',
    'icon'=>'<i class="flaticon-cogwheel-2"></i>',
    'id_table'=>'busesLine_table',
    'action_buttons'=>[
        [
        'label'=>'Crear',
        'icon'=>'<i class="la la-plus"></i>',
        'handler_js'=>'newBusesLine()',
        'color'=>'btn-primary'
        ],
      ]
    ])
    @include('partials.modal',[
    'title'=>'Crear linea de bus',
    'id'=>'modal',
    'size'=>'modal-lg',
    'action_buttons'=>[
        [
        'type'=>'submit',
        'form'=>'busesLine_form',
        'id'=>'btn_save',
        'label'=>'Guardar',
        'color'=>'btn-primary'
        ],
     ]
    ])
    <input id="action_get_form" type="hidden" value="{{ route("getFormBusesLine") }}"/>
    <input id="action_save" type="hidden" value="{{ route("saveBusesLine")}}"/>
    <input id="action_list" type="hidden" value="{{ route("listDataBusesLine") }}"/>
@endsection
@section('additional-scripts')
    <script src="{{asset("js/app/busesline/index.js")}}"></script>
@endsection