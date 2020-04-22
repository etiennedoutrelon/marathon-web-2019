@extends('layouts.master')
@section('title', 'Mon compte')
@section('content')
    <div class="container col-md-8" style="margin-top: 5%;">
        <!-- Material form register -->
        <div class="card" style="transform: none; opacity: 1;">

            <h5 class="card-header default-color white-text text-center py-4 font-weight-bold">
                <strong>Mon compte</strong>
            </h5>
            @if($user->avatar != null)
                <img class="avatar" src="{{url(Auth::user()->avatar)}}" alt="Avatar" style="margin-top: 2%;">
            @endif

            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">

                <!-- Form -->
            <form method="POST" class="text-center" style="color: #757575;" action="{{route("user.update")}}" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="id" value="{{Auth::user()->getAuthIdentifier()}}">
                <hr/>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Avatar</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                   aria-describedby="inputGroupFileAddon01" name="avatar">
                            <label class="custom-file-label" for="inputGroupFile01">Choisir un avatar</label>
                        </div>
                    </div>

                <div class="form-row">
                    <div class="col">
                        <div class="md-form">
                            <input type="text" id="materialRegisterFormFirstName"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}" required autocomplete="name" autofocus>
                            <label for="materialRegisterFormFirstName">Name </label>

                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col">
                        <!-- E-mail -->
                        <div class="md-form">
                            <input type="email" id="materialRegisterFormEmail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}" required autocomplete="email" readonly>
                            <label for="materialRegisterFormEmail">E-mail</label>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <!-- Password -->

                        <div class="md-form">
                            <input type="password" id="materialRegisterFormPassword" name="password"  required autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" aria-describedby="materialRegisterFormPasswordHelpBlock">
                            <label for="materialRegisterFormPassword">Nouveau mot de passe</label>
                            <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                Au moins 8 caractères !
                            </small>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="md-form">
                            <input type="password" id="password-confirm" name="password_confirmation"  required autocomplete="new-password" class="form-control @error('password-confirm') is-invalid @enderror" aria-describedby="materialRegisterFormPasswordHelpBlock">
                            <label for="password-confirm">Confirmation mot de passe</label>
                            <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                Au moins 8 caractères !
                            </small>
                        </div>
                        @error('password-confirm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                    <!-- Confirm button -->
                    <button class="btn default-color my-4 col-md-8" type="submit" style="color: whitesmoke; font-weight: bold;">Confirmer les modifications</button>
                    <hr>
                </form>
                <!-- Form -->

            </div>

        </div>
        <!-- Material form register -->
    </div>
@endsection
