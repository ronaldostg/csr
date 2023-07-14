@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

{{-- @section('auth_header', __('adminlte::adminlte.login_message')) --}}
@section('auth_header')

@section('auth_body')
    <div class="text-center mb-3">

        <img src="/images/logo_bank_sumut.png" alt="logo" class="w-50 h-50">
    </div>
    
    <form action="{{ $login_url }}" method="post">
        @csrf

        {{-- Email field --}}
        @if(Session::has('message'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        @endif


        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}" placeholder="{{ __('adminlte::adminlte.username') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            
        </div>
        <div class="input-group mb-3">
            <div class="captcha">
                <span>{!! captcha_img() !!}</span>
                <button type="button" class="btn btn-danger" class="reload" id="reload">
                    &#x21bb;
                </button>
            </div>


            
        </div>
        <div class="input-group mb-3">

            <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.captcha') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                     
                </div>
            </div>

            @error('captcha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


            
        </div>



            <div class="col-14">
                <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>

    </form>
@stop

@push('js')
<script type="text/javascript">
$('#reload').click(function () {
    // console.log($(".captcha span"))    
    $.ajax({
            type: 'GET',
            url: '/reload-captcha',
            success: function (data) {
                // console.log(data.captcha)
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endpush


