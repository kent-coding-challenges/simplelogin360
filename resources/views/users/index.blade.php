@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <section class="card">
                <div class="inner">
                    <nav class="card-heading navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Nav Heading -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#user-index-nav-collapse" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                                <h4 class="navbar-brand">
                                    Users
                                </h4>
                            </div>

                            <!-- Collapsible Nav Elements -->
                            <div class="collapse navbar-collapse" id="user-index-nav-collapse">
                                <form role="form" action="{{ route('users.search') }}" method="get"
                                    class="navbar-form navbar-left">
                                    <div class="form-group">
                                        <input type="search" id="searchQuery" name="q" value="{{ $query ?? "" }}"
                                            class="form-control" placeholder="Search">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="material-icons">search</i>
                                    </button>
                                </form>

                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <a href="{{ route('users.create') }}">
                                            New User
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>

                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        Name
                                    </th>
                                    <th class="hidden-xs">
                                        Email
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-default dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Action
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('users.show', $user->id) }}">
                                                            View Details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('users.edit', $user->id) }}">
                                                            Edit Details
                                                        </a>
                                                    </li>
                                                    @if ($user-> id != Auth::user()->id):
                                                        <li>

                                                            <a href="{{ route('users.destroy', $user->id) }}"
                                                                onclick="event.preventDefault();
                                                                        document.getElementById('{{ 'destroy-form-users-' . $user->id }}').submit();">
                                                                Delete
                                                            </a>

                                                            <form id="{{ 'destroy-form-users-' . $user->id }}"
                                                                    action="{{ route('users.destroy', $user->id) }}"
                                                                    method="post" style="display: none;">
                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </td>
                                        <td class="hidden-xs">
                                            {{ $user->email }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection