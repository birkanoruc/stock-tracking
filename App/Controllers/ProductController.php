<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Session;
use App\Helpers\Pagination;
use App\Middlewares\Auth;

class ProductController extends Controllers
{
    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged() && !$authMiddleware->isPermission(2)) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function index()
    {
        Pagination::calculatePagination(count($this->model("Product")->all()), 10);
        $products =  $this->model("Product")->pagination(Pagination::$offset, Pagination::$limit);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("product/index", ["products" => $products, "pagination" => Pagination::renderPagination()]);
        $this->render("template-partials/footer");
    }

    public function create()
    {
        $categories = $this->model("Category")->all();

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("product/create", ["categories" => $categories]);
        $this->render("template-partials/footer");
    }

    public function store()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $name = Helper::cleaner($_POST["name"]);
        $category_id = intval($_POST["category_id"]);
        $attributes = json_encode($_POST["attributes"]);
        $date = date("Y-m-d");

        if ($name === "" or $category_id === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $create = $this->model("Product")->create($name, $category_id, $attributes, $date);
        if ($create) {
            Helper::flashData("statu", "Başarılı", "Ürün başarıyla eklendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Ürün eklerken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function edit($id)
    {
        $product = $this->model("Product")->find($id);
        $categories = $this->model("Category")->all();

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("product/edit", ["product" => $product, "categories" => $categories]);
        $this->render("template-partials/footer");
    }

    public function update($id)
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $name = Helper::cleaner($_POST["name"]);
        $category_id = intval($_POST["category_id"]);
        $attributes = json_encode($_POST["attributes"]);
        $date = date("Y-m-d");


        if ($name === "" or $category_id === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $update = $this->model("Product")->update($id, $name, $category_id, $attributes, $date);
        if ($update) {
            Helper::flashData("statu", "Başarılı", "Ürün başarıyla düzenlendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Ürün düzenlenirken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function delete()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $id = Helper::cleaner($_POST["id"]);
        $delete = $this->model("Product")->delete($id);

        if ($delete) {
            Helper::flashData("statu", "Başarılı", "Ürün başarıyla silindi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Ürün silinirken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function import()
    {
        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("product/import");
        $this->render("template-partials/footer");
    }
}
