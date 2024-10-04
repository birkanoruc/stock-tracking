<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Session;
use App\Helpers\Pagination;
use App\Middlewares\Auth;

class InvoiceController extends Controllers
{
    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged() && !$authMiddleware->isPermission(5)) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function index()
    {
        pagination::calculatePagination(count($this->model("Invoice")->all()), 10);
        $invoices =  $this->model("Invoice")->pagination(pagination::$offset, pagination::$limit);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("invoice/index", ["invoices" => $invoices, "pagination" => pagination::renderPagination()]);
        $this->render("template-partials/footer");
    }

    public function create()
    {
        $customers = $this->model("Customer")->all();

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("invoice/create", ["customers" => $customers]);
        $this->render("template-partials/footer");
    }

    public function store()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $customer_id = intval($_POST["customer_id"]);
        $amount = intval($_POST["amount"]);
        $description = Helper::cleaner($_POST["description"]);
        $type = intval($_POST["type"]);
        $date = date("Y-m-d");

        if ($customer_id === "" or $amount === "" or $type === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $create = $this->model("Invoice")->create($customer_id, $amount, $description, $type, $date);

        if ($create) {
            Helper::flashData("statu", "Başarılı", "Fatura başarıyla eklendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Fatura eklerken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function edit($id)
    {
        $customers = $this->model("Customer")->all();
        $invoice = $this->model("Invoice")->find($id);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("invoice/edit", ["invoice" => $invoice, "customers" => $customers]);
        $this->render("template-partials/footer");
    }

    public function update($id)
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $customer_id = intval($_POST["customer_id"]);
        $amount = intval($_POST["amount"]);
        $description = Helper::cleaner($_POST["description"]);
        $type = intval($_POST["type"]);
        $date = date("Y-m-d");

        if ($customer_id === "" or $amount === "" or $type === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $update = $this->model("Invoice")->update($id, $customer_id, $amount, $description, $type, $date);
        if ($update) {
            Helper::flashData("statu", "Başarılı", "Fatura başarıyla düzenlendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Fatura düzenlenirken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function delete()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $id = Helper::cleaner($_POST["id"]);
        $delete = $this->model("Invoice")->delete($id);

        if ($delete) {
            Helper::flashData("statu", "Başarılı", "Fatura başarıyla silindi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Fatura silinirken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }
}
