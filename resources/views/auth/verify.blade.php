@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold fs-5 border-bottom text-center">
                    📩 Verify Your Email Address
                </div>

                <div class="card-body text-center">

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            ✅ A fresh verification link has been sent to your email address.
                        </div>
                    @endif

                    <p class="mb-3">
                        🕵️ Before proceeding, please check your email for a verification link.
                    </p>
                    <p class="mb-4">
                        📭 If you did not receive the email, click below to request a new one:
                    </p>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">
                            🔄 Resend Verification Email
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
