@section('content')
    @include('partials.admin_view',[
    'title'=>'Administración de unidad de medidas',
    'icon'=>'<i class="flaticon-cogwheel-2"></i>',
    'id_table'=>'measure_table',
    'action_buttons'=>[
        [
        'label'=>'Crear',
        'icon'=>'<i class="la la-plus"></i>',
        'handler_js'=>'newMeasure()',
        'color'=>'btn-primary'
        ],
      ]
    ])
    @include('partials.modal',[
    'title'=>'Crear unidad de medida',
    'id'=>'modal',
    'size'=>'modal-lg',
    'action_buttons'=>[
        [
        'type'=>'submit',
        'form'=>'measure_form',
        'id'=>'btn_save',
        'label'=>'Guardar',
        'color'=>'btn-primary'
        ],
     ]
    ])
    <input id="action_get_form" type="hidden" value="{{ route("getFormMeasure") }}"/>
    <input id="action_save" type="hidden" value="{{ route("saveMeasure")}}"/>
    <input id="action_list" type="hidden" value="{{ route("listDataMeasure") }}"/>
@endsection
@section('additional-scripts')
    <script src="{{asset("js/app/measure/index.js")}}"></script>
@endsection