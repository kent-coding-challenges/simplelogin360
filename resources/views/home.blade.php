@extends('layouts.app')

@section('content')
<div class="container">
    <section class="home-group">
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
    </section>

    <section class="home-group">
        <h2 class="home-group-heading">
            Agreed Scope / Assumptions
        </h2>

        <div class="card">
            <div class="inner">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            1.	New user registration can only be done by authenticated users (no public registration).
                        </li>
                        <li class="list-group-item">
                            2.	Only email / password based authentication is to be implemented.
                        </li>
                        <li class="list-group-item">
                            3.	Authentication layer is done with Single Factor Authentication (no MFA using OTP/SMS).
                        </li>
                        <li class="list-group-item">
                            4.	Role-based authentication is not included in scope.
                        </li>
                        <li class="list-group-item">
                            5.	Primary fields to be persisted for any user: First Name, Last Name, Email, Password
                        </li>
                        <li class="list-group-item">
                            6. Password hashing is stored using bcrypt.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
