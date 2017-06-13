<?php

namespace App\Repositories;
 
interface UserRepositoryInterface {
    public function count();
    public function getAll();
    public function search($query);
    public function find($id);
    public function store($user);
    public function update($id, $user);
    public function updatePassword($id, $old_password, $new_password);
    public function destroy($id);
}