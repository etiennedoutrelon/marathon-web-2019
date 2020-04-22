@extends('layouts.master')
@section('title', 'Connexion')
@section('content')
    <div class="container" style="margin-top: 5%;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Default form login -->
                <form class="text-center border border-light p-5" action="{{ route('login') }}" method="POST">
                    @csrf
                    <p class="h4 mb-4 font-weight-bold">Se connecter</p>

                    <!-- Email -->
                    <input type="email" id="email" class="form-control mb-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                <!-- Password -->
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror mb-4" placeholder="Password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                    <div class="d-flex justify-content-around">
                        <div>
                            <!-- Remember me -->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="defaultLoginFormRemember">Se souvenir de moi</label>
                            </div>
                        </div>
                        <div>
                        @if (Route::has('password.request'))
                            <!-- Forgot password -->
                                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                            @endif
                        </div>
                    </div>

                    <!-- Sign in button -->
                    <button class="btn default-color btn-block my-4" type="submit" style="color: whitesmoke; font-weight: bold;">Connexion</button>

                    <!-- Register -->
                    <p>Pas encore membre ?
                        <a href="{{ route('register') }}">Inscrivez-vous !</a>
                    </p>


                </form>
                <!-- Default form login -->
            </div>
        </div>
    </div>
@endsection

