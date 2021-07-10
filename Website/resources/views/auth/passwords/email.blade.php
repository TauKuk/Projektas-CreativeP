@extends('layouts.app')

@section('content')
<div class="gradient-card" style="height: 100%;">
    <div class="form">
        <div class="form-header">{{ __('Slaptažodžio atstatymas') }}</div>

        <div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <label for="email" class="form-label">{{ __('El-pašto adresas') }}</label>

                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <div role="alert" class="error-message">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-label">
                    <button type="submit" class="btn btn-warning">
                        {{ __('Siųsti nuorodą') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
