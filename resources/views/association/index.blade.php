@section('content')
    @include('partials.admin_view',[
    'title'=>'Administración de asociaciones',
    'icon'=>'<i class="flaticon-cogwheel-2"></i>',
    'id_table'=>'association_table',
    'action_buttons'=>[
        [
        'label'=>'Crear',
        'icon'=>'<i class="la la-plus"></i>',
        'handler_js'=>'newAssociation()',
        'color'=>'btn-primary'
        ],
      ]
    ])
    @include('partials.modal',[
    'title'=>'Crear Asociación',
    'id'=>'modal',
    'size'=>'modal-lg',
    'action_buttons'=>[
        [
        'type'=>'submit',
        'form'=>'association_form',
        'id'=>'btn_save',
        'label'=>'Guardar',
        'color'=>'btn-primary'
        ],
     ]
    ])
    <input id="action_get_form" type="hidden" value="{{ route("getFormAssociations") }}"/>
    <input id="action_save" type="hidden" value="{{ route("saveAssociations")}}"/>
    <input id="action_list" type="hidden" value="{{ route("listDataAssociations") }}"/>
@endsection
@section('additional-scripts')
    <script src="{{asset("js/app/association/index.js")}}"></script>
@endsection