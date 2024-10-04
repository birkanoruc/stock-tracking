<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Session;
use App\Helpers\Pagination;
use App\Middlewares\Auth;
use App\Helpers\AuthHelpers;

class OrderController extends Controllers
{
    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged() && !$authMiddleware->isPermission(8)) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function index()
    {
        Pagination::calculatePagination(count($this->model("Order")->all()), 10);
        $orders =  $this->model("Order")->pagination(Pagination::$offset, Pagination::$limit);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("order/index", ["orders" => $orders, "pagination" => Pagination::renderPagination()]);
        $this->render("template-partials/footer");
    }

    public function create()
    {
        $products = $this->model("Product")->all();
        $customers = $this->model("Customer")->all();

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("order/create", ["customers" => $customers, "products" => $products]);
        $this->render("template-partials/footer");
    }

    public function store()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $customer_id = intval($_POST["customer_id"]);
        $company_name = Helper::cleaner($_POST["company_name"]);
        $order_date = Helper::cleaner($_POST["order_date"]);
        $products = json_encode($_POST["products"]);
        $admin_id = AuthHelpers::getUserId();
        $date = date("Y-m-d");

        if ($customer_id === "" or $products === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $create = $this->model("Order")->create($customer_id, $company_name, $order_date, $products, $admin_id, $date);
        if ($create) {
            Helper::flashData("statu", "Başarılı", "Sipariş başarıyla eklendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Sipariş eklerken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function edit($id)
    {
        $products = $this->model("Product")->all();
        $customers = $this->model("Customer")->all();
        $order = $this->model("Order")->find($id);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("order/edit", ["order" => $order, "customers" => $customers, "products" => $products]);
        $this->render("template-partials/footer");
    }

    public function update($id)
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $customer_id = intval($_POST["customer_id"]);
        $company_name = Helper::cleaner($_POST["company_name"]);
        $order_date = Helper::cleaner($_POST["order_date"]);
        $products = json_encode($_POST["products"]);
        $admin_id = AuthHelpers::getUserId();
        $date = date("Y-m-d");

        if ($customer_id === "" or $products === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $update = $this->model("Order")->update($id, $customer_id, $company_name, $order_date, $products, $admin_id, $date);
        if ($update) {
            Helper::flashData("statu", "Başarılı", "Sipariş başarıyla düzenlendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Sipariş düzenlenirken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function delete()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $id = Helper::cleaner($_POST["id"]);
        $delete = $this->model("Order")->delete($id);
        if ($delete) {
            Helper::flashData("statu", "Başarılı", "Sipariş başarıyla silindi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Sipariş silinirken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function products()
    {
        $products = $this->model("Product")->all();
        echo json_encode($products);
    }

    public function show($id)
    {
        $order = $this->model("Order")->find($id);
        $customer = $this->model("Customer")->find($order["customer_id"]);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("order/show", ["order" => $order, "customer" => $customer]);
        $this->render("template-partials/footer");
    }
}
