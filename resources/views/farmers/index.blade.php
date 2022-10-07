@section('content')
    @include('partials.admin_view',[
    'title'=>'Lista de vendedoras',
    'icon'=>'<i class="flaticon-cogwheel-2"></i>',
    'id_table'=>'farmer_table',
      ])
      
    <input id="action_list" type="hidden" value="{{ route("listDataFarmer") }}"/>
    <input id="action_index_product" type="hidden" value="{{ route("indexViewProduct") }}"/>
@endsection
@section('additional-scripts')
    <script src="{{asset("js/app/farmer/index.js")}}"></script>
@endsection