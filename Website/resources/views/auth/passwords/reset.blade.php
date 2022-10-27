@extends('layouts.app')

@section('content')
<div class="gradient-card" style="height: 100%;">
    <div class="form">
        <div class="form-header">Atsatyti slaptažodį</div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="form-label">El. pašto adresas</label>

                    <div>
                        <input id="email" type="email" class="normalise-font form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span role="alert" class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="form-label">Slaptažodis</label>

                    <div>
                        <input id="password" type="password" class="normalise-font form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span role="alert" class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password-confirm" class="form-label">Patvirtinti slaptažodį</label>

                    <div>
                        <input id="password-confirm" type="password" class="normalise-font form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-label">
                    <button type="submit" class="btn btn-warning">
                        Atstatyti slaptažodį
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
