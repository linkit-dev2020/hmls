@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('تحقق من عنوان بريدك الإلكتروني') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('م إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.') }}
                        </div>
                    @endif

                    {{ __('قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني لمعرفة رابط التحقق.') }}
                    {{ __('إذا لم تتلقى البريد الإلكتروني') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
