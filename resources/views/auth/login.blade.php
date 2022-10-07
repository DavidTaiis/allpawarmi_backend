@extends('layouts.login2')
@section('content')

        <!--begin::Login-->
        <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto ">
                <!--begin::Aside Top-->
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-position-y: calc(50% + 0rem); background-image: url({{asset("images/mesasana.jpg")}})"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="login-content flex-row-fluid d-flex flex-column ">
                <!--begin::Wrapper-->
                <div class="d-flex flex-row-fluid flex-center">
                    <!--begin::Signin-->
                    <div class="login-form">
                        <!--begin::Form-->
                            <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_login_singin_form" method="POST"
                              action="{{ route('customLogin') }}">
                        {{ csrf_field() }}
                            <!--begin::Title-->
                            <div class="pb-5 pb-lg-15">
                                <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Ingresar</h3>
                            </div>
                            <!--begin::Title-->
                            <!--begin::Form group-->
                            <br>
                            <label class="font-size-h6 font-weight text-danger">
                            {{Session('inactiveCompany')}}
                            {{Session('notAuthorized')}}
                            {{Session('failedPassword')}}
                            {{Session('failedEmail')}}
                            </label>
                            <br>
                            <label class="font-size-h6 font-weight text-danger">{{session('error')}}</label>
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">Tu correo</label>
                                <input class="form-control h-auto py-7 px-6 rounded-lg border-0" type="text" name="email" autocomplete="off" value="{{session('email')}}"/>
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Contraseña</label>
                                </div>
                                <input class="form-control h-auto py-7 px-6 rounded-lg border-0" type="password" name="password" autocomplete="off" />
                            </div>
                            <!--end::Form group-->
                            <!--begin::Action-->
                            <div class="pb-lg-0 pb-5">
                                <button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Ingresar</button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
   
@endsection
