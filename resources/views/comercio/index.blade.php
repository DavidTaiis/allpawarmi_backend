@section('content')
    @include('partials.admin_view',[
    'title'=>'Administración de puntos de comercio',
    'icon'=>'<i class="flaticon-cogwheel-2"></i>',
    'id_table'=>'comercio_table',
    'action_buttons'=>[
        [
        'label'=>'Crear',
        'icon'=>'<i class="la la-plus"></i>',
        'handler_js'=>'newComercio()',
        'color'=>'btn-primary'
        ],
      ]
    ])
    @include('partials.modal',[
    'title'=>'Crear punto de comercio',
    'id'=>'modal',
    'action_buttons'=>[
        [
        'type'=>'submit',
        'form'=>'comercio_form',
        'id'=>'btn_save',
        'label'=>'Guardar',
        'color'=>'btn-primary'
        ],
     ]
    ])
    <input id="action_get_form" type="hidden" value="{{ route("getFormComercio") }}"/>
    <input id="action_save" type="hidden" value="{{ route("saveComercio")}}"/>
    <input id="action_list" type="hidden" value="{{ route("listDataComercio") }}"/>
@endsection
@section('additional-scripts')
    <script src="{{asset("js/app/comercio/index.js")}}"></script>
@endsection