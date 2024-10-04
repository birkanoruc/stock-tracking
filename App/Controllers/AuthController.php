<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Session;
use App\Middlewares\Auth;

class AuthController extends Controllers
{
    public function logout()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged()) {
            Helper::redirect("/auth/login");
            die();
        }

        Session::flush();
        return Helper::redirect("/auth/login");
    }

    public function login()
    {
        $authMiddleware = new Auth;
        if ($authMiddleware->isLogged()) {
            Helper::redirect();
            die();
        }

        $this->render("auth/login");
    }

    public function attemp()
    {
        $authMiddleware = new Auth;
        if ($authMiddleware->isLogged()) {
            Helper::redirect();
            die();
        }

        if (!$_POST) {
            return Helper::redirect();
        }

        $email = Helper::cleaner($_POST['email']);
        $password = Helper::cleaner($_POST['password']);

        if ($email === "" or $password === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $control = $this->model('Admin')->control($email, md5($password));

        if (!$control) {
            Helper::flashData("statu", "Başarısız", "Böyle bir kullanıcı yok!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        Session::flash("email", $email);
        Session::flash("password", md5($password));
        Helper::redirect();
    }
}
