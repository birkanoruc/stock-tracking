<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Pagination;
use App\Middlewares\Auth;
use App\Helpers\Session;

class CashController extends Controllers
{

    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged() && !$authMiddleware->isPermission(1)) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function index()
    {
        pagination::calculatePagination(count($this->model("Cash")->all()), 10);
        $cashs =  $this->model("Cash")->pagination(pagination::$offset, pagination::$limit);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("cash/index", ["cashs" => $cashs, "pagination" => pagination::renderPagination()]);
        $this->render("template-partials/footer");
    }

    public function create()
    {
        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("cash/create");
        $this->render("template-partials/footer");
    }

    public function store()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $name = Helper::cleaner($_POST["name"]);
        $date = date("Y-m-d");

        if ($name === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $create = $this->model("Cash")->create($name, $date);
        if ($create) {
            Helper::flashData("statu", "Başarılı", "Kasa başarıyla eklendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Kasa eklerken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function edit($id)
    {
        $cash = $this->model("Cash")->find($id);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("cash/edit", ["cash" => $cash]);
        $this->render("template-partials/footer");
    }

    public function update($id)
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $name = Helper::cleaner($_POST["name"]);
        $date = date("Y-m-d");

        if ($name === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $update = $this->model("Cash")->update($id, $name, $date);
        if ($update) {
            Helper::flashData("statu", "Başarılı", "Kasa başarıyla düzenlendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Kasa düzenlenirken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function delete()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $id = Helper::cleaner($_POST["id"]);
        $delete = $this->model("Cash")->delete($id);

        if ($delete) {
            Helper::flashData("statu", "Başarılı", "Kasa başarıyla silindi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Kasa silinirken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }
}
