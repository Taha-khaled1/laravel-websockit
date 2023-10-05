<?php

namespace App\Services;

use App\Models\User;

class UserServices
{
    public function getUserData()
    {
        $data = User::all();
        return $data;
    }

    public function getSingleUser($id)
    {
        $data = User::find($id);
        return $data;
    }




    public function getUserCreate($data)
    {
        return User::create($data);
    }




    public function getUserUpadte($id, $data)
    {
        $user = $this->getSingleUser($id);
        $user->update($data);
        $user->save();
        return $user;
    }


    public function deleteUser($id)
    {
        $user = $this->getSingleUser($id);
        $user->delete();
    }
}