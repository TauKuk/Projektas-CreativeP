@extends('layouts.app')

@section('content')
<div class="gradient-card" style="height: 100%;">
    <div class="form">
        <div class="form-header">{{ __('Prisijungimas') }}</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="form-label">{{ __('El-pašto adresas') }}</label>

                <div>
                    <input id="email" type="email" class="normalise-font form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" style="font-family: 'Nunito', sans-serif;" required autocomplete="off" autofocus>

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
                    <input id="password" type="password" class="normalise-font form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <div role="alert" class="error-message">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            <div>
                <div>
                    <div>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label for="remember" class="form-label">
                            {{ __('Prisiminti paskyrą') }}
                        </label>
                    </div>
                </div>
            </div>

            <div>
                <div class="form-label">
                    <button type="submit" class="btn btn-warning">
                        {{ __('Prisijungti') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="margin-left: 0.5em;" class="ytb-animation">
                            {{ __('Pamiršai slaptažodį?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
