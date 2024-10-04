<?php

namespace App\Middlewares;

use App\Models\Admin;
use App\Helpers\Session;
use App\Helpers\AuthHelpers;
use App\Helpers\Helper;

class Auth
{
    public static function isLogged()
    {
        if (Session::has("email") && Session::has("password")) {
            $admin = (new Admin)->control(Session::get("email"), Session::get("password"));
            return !empty($admin);
        }
        return false;
    }

    public static function isPermission($permissionId)
    {
        $permissions = explode(",", AuthHelpers::getUserPermissions());
        if (in_array($permissionId, $permissions)) {
            return true;
        }
        return false;
    }
}
