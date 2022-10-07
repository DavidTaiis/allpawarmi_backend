@section('content')
    @include('partials.admin_view',[
    'title'=>'Administración de centros de acopio',
    'icon'=>'<i class="flaticon-cogwheel-2"></i>',
    'id_table'=>'acopio_table',
    'action_buttons'=>[
        [
        'label'=>'Crear',
        'icon'=>'<i class="la la-plus"></i>',
        'handler_js'=>'newAcopio()',
        'color'=>'btn-primary'
        ],
      ]
    ])
    @include('partials.modal',[
    'title'=>'Crear centro de acopio',
    'id'=>'modal',
    'size'=>'modal-lg',
    'action_buttons'=>[
        [
        'type'=>'submit',
        'form'=>'acopio_form',
        'id'=>'btn_save',
        'label'=>'Guardar',
        'color'=>'btn-primary'
        ],
     ]
    ])
    <input id="action_get_form" type="hidden" value="{{ route("getFormAcopio") }}"/>
    <input id="action_save" type="hidden" value="{{ route("saveAcopio")}}"/>
    <input id="action_list" type="hidden" value="{{ route("listDataAcopio") }}"/>
@endsection
@section('additional-scripts')
    <script src="{{asset("js/app/acopio/index.js")}}"></script>
@endsection