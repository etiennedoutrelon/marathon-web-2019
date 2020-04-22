@extends('layouts.admin')
@section('title', 'Liste des membres')

@section('content')

    <div class="row wow fadeIn">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="teal lighten-4">
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>E-mail</th>
                            <th>Rang d'accès</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td class="font-weight-bold">#{{$member->id}}</td>
                                <td>{{$member->name}}</td>
                                <td>{{$member->email}}</td>
                                <td>
                                    <form method="POST" action="{{route('member.update')}}">
                                        @csrf
                                        <input type="hidden" value="{{$member->id}}" name="id">
                                        <button type="submit" class="btn btn-sm @if($member->administrateur === 1) btn-teal @else btn-blue-grey @endif font-weight-bold" style="width: 100px;">@if($member->administrateur === 1) Admin @else User @endif</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
