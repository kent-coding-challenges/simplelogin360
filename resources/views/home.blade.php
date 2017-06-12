@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="home-group-heading">
        Management
    </h2>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route('users.index') }}" class="icon-box-link">
                <i class="material-icons text-theme">person_pin</i>
                <span class="text"> 
                    User Management
                </span>
            </a>
        </div>
    </div>
</div>
@endsection
