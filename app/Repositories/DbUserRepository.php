<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DbUserRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        $this->page_size = 5;
    }

    public function count()
    {
        return User::count();
    }

    public function getAll()
    {
        return User::paginate($this->page_size);
    }

    public function search($query)
    {
        // Append/prepend query with % for LIKE comparison.
        // Note: Laravel's db query builder will parameterize the query to safeguard from SQL injection.
        $query = '%' . trim($query) . '%';

        return DB::table('users')
            ->where('first_name', 'like', $query)
            ->orWhere('last_name', 'like', $query)
            ->orWhere('email', 'like', $query)
            ->paginate($this->page_size);
    }

    public function find($id)
    {
		return User::find($id);
    }

    public function store($user)
    {
        // Store new user.
        $user_to_create = new User();
        $user_to_create->first_name = $user->first_name;
        $user_to_create->last_name = $user->last_name;
        $user_to_create->email = $user->email;
        $user_to_create->password = bcrypt($user->password);
        $user_to_create->save();

        return $user_to_create;
    }

    public function update($id, $user)
    {
        $user_to_update = $this->find($id);
        if (!$user_to_update) {
            return null;
        }

        // Update fields which are allowed to be edited.
        $user_to_update->first_name = $user->first_name;
        $user_to_update->last_name = $user->last_name;
        $user_to_update->email = $user->email;
        $user_to_update->save();
        
        return $user_to_update;
    }

    public function updatePassword($id, $old_password, $new_password)
    {
        $user_to_update = $this->find($id);
        if (!$user_to_update) {
            return null;
        }

        // Validate old password.
        if (!Hash::check($old_password, $user_to_update->password)) {
            return null;
        }

        $user_to_update->password = bcrypt($new_password);
        $user_to_update->save();

        return $user_to_update;
    }
    
    public function destroy($id)
    {
        $user_to_destroy = $this->find($id);
        if (!$user_to_destroy) {
            return false;
        }

        $user_to_destroy->delete();
        return true;
    }
}