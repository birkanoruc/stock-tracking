<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\AuthHelpers;
use App\Helpers\Helper;
use App\Helpers\Session;
use App\Middlewares\Auth;

class ProfileController extends Controllers
{

    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged()) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function index()
    {
        $admin = $this->model("Admin")->find(AuthHelpers::getUserId());

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("profile", ["admin" => $admin]);
        $this->render("template-partials/footer");
    }

    public function update()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $admin = $this->model("Admin")->find(AuthHelpers::getUserId());

        $name = Helper::cleaner($_POST["name"]);
        $surname = Helper::cleaner($_POST["surname"]);
        $email = Helper::cleaner($_POST["email"]);
        $password = Helper::cleaner($_POST["password"]);
        $permissions = $admin["permissions"];
        $password = $password != "" ? md5($password) : $admin["password"];
        $image = ($_FILES["image"]["tmp_name"] != "") ? file_get_contents($_FILES["image"]["tmp_name"]) : $admin["image"];
        $date = date("Y-m-d");

        if ($name === "" or $email === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $update = $this->model("Admin")->update(AuthHelpers::getUserId(), $name, $surname, $email, $password, $permissions, $image, $date);

        if ($update) {
            Helper::flashData("statu", "Başarılı", "Profil başarıyla düzenlendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Profil düzenlenirken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }
}
