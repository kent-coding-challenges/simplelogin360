@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <section class="card">
                <div class="inner">
                    <div class="card-heading">
                        Users

                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary pull-right">
                            New User
                        </a>
                    </div>

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
                                                    <li>
                                                        <a href="#">
                                                            Change Password
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