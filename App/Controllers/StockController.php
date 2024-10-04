<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Pagination;
use App\Middlewares\Auth;
use App\Helpers\Session;

class StockController extends Controllers
{
    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged() && !$authMiddleware->isPermission(4)) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function index()
    {
        Pagination::calculatePagination(count($this->model("Stock")->all()), 10);
        $stocks =  $this->model("Stock")->pagination(Pagination::$offset, Pagination::$limit);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("stock/index", ["stocks" => $stocks, "pagination" => Pagination::renderPagination()]);
        $this->render("template-partials/footer");
    }

    public function create()
    {
        $products = $this->model("Product")->all();
        $customers = $this->model("Customer")->all();
        $cashs = $this->model("Cash")->all();

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("stock/create", ["products" => $products, "customers" => $customers, "cashs" => $cashs]);
        $this->render("template-partials/footer");
    }

    public function store()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $product_id = intval($_POST["product_id"]);
        $customer_id = intval($_POST["customer_id"]);
        $cash_id = intval($_POST["cash_id"]);
        $action_type = intval($_POST["action_type"]);
        $quantity = intval($_POST["quantity"]);
        $price = Helper::cleaner($_POST["price"]);
        $date = date("Y-m-d");

        if ($product_id === "" or $customer_id === "" or $cash_id === "" or $action_type === "" or $quantity === "" or $price === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $create = $this->model("Stock")->create($product_id, $customer_id, $cash_id, $action_type, $quantity, $price, $date);
        if ($create) {
            Helper::flashData("statu", "Başarılı", "Stok başarıyla eklendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Stok eklerken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function edit($id)
    {
        $products = $this->model("Product")->all();
        $customers = $this->model("Customer")->all();
        $cashs = $this->model("Cash")->all();
        $stock = $this->model("Stock")->find($id);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("stock/edit", params: ["stock" => $stock, "products" => $products, "customers" => $customers, "cashs" => $cashs]);
        $this->render("template-partials/footer");
    }

    public function update($id)
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $product_id = intval($_POST["product_id"]);
        $customer_id = intval($_POST["customer_id"]);
        $cash_id =  intval($_POST["cash_id"]);
        $action_type = intval($_POST["action_type"]);
        $quantity = intval($_POST["quantity"]);
        $price = Helper::cleaner($_POST["price"]);
        $date = date("Y-m-d");

        if ($product_id === "" or $customer_id === "" or $cash_id === "" or $action_type === "" or $quantity === "" or $price === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $update = $this->model("Stock")->update($id, $product_id, $customer_id, $cash_id, $action_type, $quantity, $price, $date);
        if ($update) {
            Helper::flashData("statu", "Başarılı", "Stok başarıyla düzenlendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Stok düzenlenirken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function delete()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $id = Helper::cleaner($_POST["id"]);
        $delete = $this->model("Stock")->delete($id);

        if ($delete) {
            Helper::flashData("statu", "Başarılı", "Stok başarıyla silindi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Stok silinirken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }
}
