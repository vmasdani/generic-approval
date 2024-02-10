<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    function save(Request $r)
    {
        $bod = json_decode($r->getContent());

        $u = User::query()->where('id', '=', isset($bod->id) ? $bod->id : 0)->first();

        if ($u === null) {
            $u = new User;
        }

        $u->name = isset($bod->name) ? $bod->name : $u->name;
        $u->email = isset($bod->email) ? $bod->email : $u->email;
        $u->username = isset($bod->username) ? $bod->username : $u->username;

        if (isset($bod->password) && ($u->password === null || $u->password !== $bod->password)) {
            $u->password = bcrypt($bod->password);
        }

        $u->save();

        return response($u);
    }

    function login(Request $r)
    {
        $bod = json_decode($r->getContent());

        $username = $bod->username;
        $password = $bod->password;

        $foundUser = User::query()->where('username','=',$username)->first();
        
        if(!$foundUser){
            return response('User not found', 404);
        }

        return $foundUser;
    }
}
