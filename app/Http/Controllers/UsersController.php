<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \App\Repositories\UserRepositoryInterface $repository (Dependency Injection)
     * @return void
     */
	public function __construct(UserRepositoryInterface $repository)
    {
        $this->middleware('auth');
		$this->repository = $repository;
    }

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->getAll();
        return view('users.index', compact('users'));
    }

    /**
     * Search through users' listing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Get search query and validate $query is not empty.
        $query = $request['q'];
        if ($query == null) {
            return redirect()->route('users.index');
        }

        $users = $this->repository->search($query);
        return view('users.index', compact('users'))
            ->with('query', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user = $this->repository->store($user);

        // Get feedback to pass back the to the view.
        if ($user) {
            $feedback_type = 'success';
            $feedback_message = 'Successfully created a new user.';
        } else {
            $feedback_type = 'error';
            $feedback_message = 'Unable to create a new user.';
        }

        return redirect()->route('users.index')
            ->with('feedback_type', $feedback_type)
            ->with('feedback_message', $feedback_message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);
        if (!$user) {
            abort(404);
        }

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
        if (!$user) {
            abort(404);
        }

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate incoming data, ignoring current user for email unique constraint.
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id
        ]);

        // Update user details and save to db.
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user = $this->repository->update($id, $user);

        // Get feedback to pass back the to the view.
        if ($user) {
            $feedback_type = 'success';
            $feedback_message = 'Successfully updated user details.';
        } else {
            $feedback_type = 'error';
            $feedback_message = 'Unable to update user details.';
        }

        return redirect()->route('users.index')
            ->with('feedback_type', $feedback_type)
            ->with('feedback_message', $feedback_message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            abort(403, 'You are not allowed to delete your own user account.');
        }

        $is_success = $this->repository->destroy($id);

        // Get feedback to pass back the to the view.
        if ($is_success) {
            $feedback_type = 'success';
            $feedback_message = 'Successfully deleted user.';
        } else {
            $feedback_type = 'error';
            $feedback_message = 'Unable to delete user.';
        }

        return redirect()->route('users.index')
            ->with('feedback_type', $feedback_type)
            ->with('feedback_message', $feedback_message);
    }
}
