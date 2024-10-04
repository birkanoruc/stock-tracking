<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Pagination;
use App\Middlewares\Auth;
use App\Helpers\Session;

class CategoryController extends Controllers
{

    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged() && !$authMiddleware->isPermission(0)) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function index()
    {
        pagination::calculatePagination(count($this->model("Category")->all()), 10);
        $categories =  $this->model("Category")->pagination(pagination::$offset, pagination::$limit);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("category/index", ["categories" => $categories, "pagination" => pagination::renderPagination()]);
        $this->render("template-partials/footer");
    }

    public function create()
    {
        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("category/create");
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

        $create = $this->model("Category")->create($name, $date);
        if ($create) {
            Helper::flashData("statu", "Başarılı", "Kategori başarıyla eklendi!", "success");
        } else {
            Helper::flashData("statu", "Başarılı", "Kategori eklerken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", data: Session::get("statu"));
    }

    public function edit($id)
    {
        $category = $this->model("Category")->find($id);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("category/edit", ["category" => $category]);
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

        $update = $this->model("Category")->update($id, $name, $date);
        if ($update) {
            Helper::flashData("statu",  "Başarılı", "Kategori başarıyla düzenlendi!", "success");
        } else {
            Helper::flashData("statu",  "Başarılı", "Kategori düzenlenirken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", data: Session::get("statu"));
    }

    public function delete()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $id = Helper::cleaner($_POST["id"]);
        $delete = $this->model("Category")->delete($id);
        if ($delete) {
            Helper::flashData("statu", "Başarılı", "Kategori başarıyla silindi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Kategori silinirken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }
}
