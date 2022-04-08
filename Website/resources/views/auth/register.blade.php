@extends('layouts.app')

@section('content')
<div class="gradient-card" style="height: 100%;">
    <div class="form">
        <div class="form-header">{{ __('Registracija') }}</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name" class="form-label">{{ __('Vardas') }}</label>

                <div>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>

                    @error('name')
                        <div role="alert" class="error-message">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email" class="form-label">{{ __('El-pašto adresas') }}</label>

                <div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">

                    @error('email')
                        <div role="alert" class="error-message">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password" class="form-label">{{ __('Slaptažodis') }}</label>

                <div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <div role="alert" class="error-message">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password-confirm" class="form-label">{{ __('Patvirtinti slaptažodį') }}</label>

                <div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-label">
                <button type="submit" class="btn btn-warning" style="margin-top: 0.3em;">
                    {{ __('Registruotis') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
