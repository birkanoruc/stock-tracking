<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Pagination;
use App\Helpers\Session;
use App\Middlewares\Auth;

class AdminController extends Controllers
{

    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged() && !$authMiddleware->isPermission(7)) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function index()
    {
        Pagination::calculatePagination(count($this->model("Admin")->all()), 10);
        $admins =  $this->model("Admin")->pagination(Pagination::$offset, Pagination::$limit);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("admin/index", ["admins" => $admins, "pagination" => Pagination::renderPagination()]);
        $this->render("template-partials/footer");
    }

    public function create()
    {
        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("admin/create");
        $this->render("template-partials/footer");
    }

    public function store()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $name = Helper::cleaner($_POST["name"]);
        $surname = Helper::cleaner($_POST["surname"]);
        $email = Helper::cleaner($_POST["email"]);
        $password = Helper::cleaner($_POST["password"]);
        $permissions = isset($_POST["permissions"]) ? implode(",", $_POST["permissions"]) : "";
        $date = date("Y-m-d");

        if ($name === "" or $email === "" or $password === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $create = $this->model("Admin")->create($name, $surname, $email, md5($password), $permissions, $date);

        if ($create) {
            Helper::flashData("statu", "Başarılı", "Admin başarıyla eklendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız",  "Admin eklerken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function edit($id)
    {
        $admin = $this->model("Admin")->find($id);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("admin/edit", ["admin" => $admin]);
        $this->render("template-partials/footer");
    }

    public function update($id)
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $admin = $this->model("Admin")->find($id);

        $name = Helper::cleaner($_POST["name"]);
        $surname = Helper::cleaner($_POST["surname"]);
        $email = Helper::cleaner($_POST["email"]);
        $password = Helper::cleaner($_POST["password"]);
        $permissions = isset($_POST["permissions"]) ? implode(",", $_POST["permissions"]) : "";
        $password = $password != "" ? md5($password) : $admin["password"];
        $image = $admin["image"];
        $date = date("Y-m-d");

        if ($name === "" or $email === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $update = $this->model("Admin")->update($id, $name, $surname, $email, $password, $permissions, $image, $date);
        if ($update) {
            Helper::flashData("statu", "Başarılı", "Admin başarıyla düzenlendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Admin düzenlenirken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function delete()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $id = Helper::cleaner($_POST["id"]);
        $delete = $this->model("Admin")->delete($id);

        if ($delete) {
            Helper::flashData("statu", "Başarılı", "Admin başarıyla silindi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Admin silinirken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }
}
