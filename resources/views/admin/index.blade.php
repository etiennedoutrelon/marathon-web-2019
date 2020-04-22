@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

    <div class="row wow fadeIn">
        <div class="mb-4 col-6">
            <!--Card-->
            <div class="card">
                <div class="card-header font-weight-bold text-center text-uppercase">Statistiques</div>
                <!--Card content-->
                <div class="card-body">

                    <!-- List group links -->
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action waves-effect">Utilisateurs :
                            <span class="badge badge-primary badge-pill float-right">{{$nbUsers}}
                            <i class="fas fa-arrow-up ml-1"></i>
                        </span>
                        </a>
                        <a class="list-group-item list-group-item-action waves-effect">Nombre de séries :
                            <span class="badge badge-primary badge-pill float-right">{{$nbSeries}}
                            <i class="fas fa-arrow-up ml-1"></i>
                        </span>
                        </a>
                        <a class="list-group-item list-group-item-action waves-effect">Nombre d'épisodes :
                            <span class="badge badge-primary badge-pill float-right">{{$nbEpisodes}}
                            <i class="fas fa-arrow-up ml-1"></i>
                        </span>
                        </a>
                        <a class="list-group-item list-group-item-action waves-effect">Commentaires :
                            <span class="badge badge-primary badge-pill float-right">{{$nbComments}}
                            <i class="fas fa-arrow-up ml-1"></i>
                        </span>
                        </a>
                        <a class="list-group-item list-group-item-action waves-effect">Nombre de genres :
                            <span class="badge badge-primary badge-pill float-right">{{$nbGenres}}
                            <i class="fas fa-arrow-up ml-1"></i>
                        </span>
                        </a>
                    </div>
                    <!-- List group links -->

                </div>
            </div>
            <!--/.Card-->
        </div>
        <div class="mb-4 col-6">
            <!--Card-->
            <div class="card">
                <div class="card-header font-weight-bold text-center text-uppercase">Guide d'utilisation</div>
                <!--Card content-->
                <div class="card-body">
                    <p>
                        En accédant à l'administration, vous pouvez redéfinir le rang d'accès de chaque membre de cette application.
                    </p>
                    <div class="alert alert-info">
                        Pour définir l'accès, il vous suffit de cliquer sur le bouton <strong>DEFAULT</strong> ou <strong>ADMIN</strong> associé à chaque utilisateur.
                    </div>
                    <div class="alert alert-danger font-weight-bold">
                        Si vous retirez votre propre accès administrateur, vous n'aurez plus accès à ce panel d'administration !
                    </div>
                </div>
            </div>
            <!--/.Card-->
        </div>
    </div>

@endsection
