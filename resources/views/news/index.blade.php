@section('content')
    @include('partials.admin_view',[
    'title'=>'Administración de noticias',
    'icon'=>'<i class="flaticon-cogwheel-2"></i>',
    'id_table'=>'news_table',
    'action_buttons'=>[
        [
        'label'=>'Crear',
        'icon'=>'<i class="la la-plus"></i>',
        'handler_js'=>'newNews()',
        'color'=>'btn-primary'
        ],
      ]
    ])
    @include('partials.modal',[
    'title'=>'Crear noticia',
    'id'=>'modal',
    'size'=>'modal-lg',
    'action_buttons'=>[
        [
        'type'=>'submit',
        'form'=>'news_form',
        'id'=>'btn_save',
        'label'=>'Guardar',
        'color'=>'btn-primary'
        ],
     ]
    ])
    <input id="action_get_form" type="hidden" value="{{ route("getFormNews") }}"/>
    <input id="action_save" type="hidden" value="{{ route("saveNews")}}"/>
    <input id="action_list" type="hidden" value="{{ route("listDataNews") }}"/>
@endsection
@section('additional-scripts')
    <script src="{{asset("js/app/news/index.js")}}"></script>
@endsection