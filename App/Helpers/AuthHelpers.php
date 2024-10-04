<?php

namespace App\Helpers;

use App\Models\Admin;
use App\Helpers\Session;

class AuthHelpers
{
    public static function getUserInfo()
    {
        if (Session::has("email") && Session::has("password")) {
            return (new Admin)->query("SELECT * FROM admins WHERE email=? AND password=?", [Session::get("email"), Session::get("password")])->first();
        }

        return false;
    }

    public static function getUserId()
    {
        return self::getUserInfo()["id"];
    }

    public static function getUserName()
    {
        return self::getUserInfo()["name"];
    }

    public static function getUserSurname()
    {
        return self::getUserInfo()["surname"];
    }

    public static function getUserFullname()
    {
        return self::getUserName() . " " . self::getUserSurname();
    }

    public static function getUserPermissions()
    {
        return self::getUserInfo()["permissions"];
    }
}
