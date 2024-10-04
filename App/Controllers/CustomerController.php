<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Pagination;
use App\Middlewares\Auth;
use App\Helpers\Session;

class CustomerController extends Controllers
{
    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged() && !$authMiddleware->isPermission(3)) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function index()
    {
        Pagination::calculatePagination(count($this->model("Customer")->all()), 10);
        $customers =  $this->model("Customer")->pagination(Pagination::$offset, Pagination::$limit);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("customer/index", ["customers" => $customers, "pagination" => pagination::renderPagination()]);
        $this->render("template-partials/footer");
    }

    public function create()
    {
        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("customer/create");
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
        $phone = Helper::cleaner($_POST["phone"]);
        $address = Helper::cleaner($_POST["address"]);
        $note = Helper::cleaner($_POST["note"]);
        $company = Helper::cleaner($_POST["company"]);
        $date = date("Y-m-d");

        if ($name === "" or $surname === "" or $address === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $create = $this->model("Customer")->create($name, $surname, $email, $phone, $address, $note, $company, $date);
        if ($create) {
            Helper::flashData("statu", "Başarılı", "Müşteri başarıyla eklendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Müşteri eklerken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function edit($id)
    {
        $customer = $this->model("Customer")->find($id);

        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("customer/edit", ["customer" => $customer]);
        $this->render("template-partials/footer");
    }

    public function update($id)
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $name = Helper::cleaner($_POST["name"]);
        $surname = Helper::cleaner($_POST["surname"]);
        $email = Helper::cleaner($_POST["email"]);
        $phone = Helper::cleaner($_POST["phone"]);
        $address = Helper::cleaner($_POST["address"]);
        $note = Helper::cleaner($_POST["note"]);
        $company = Helper::cleaner($_POST["company"]);
        $date = date("Y-m-d");

        if ($name === "" or $surname === "" or $address === "") {
            Helper::flashData("statu", "Başarısız", "Lütfen tüm alanları giriniz!", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }

        $update = $this->model("Customer")->update($id, $name, $surname, $email, $phone, $address, $note, $company, $date);
        if ($update) {
            Helper::flashData("statu", "Başarılı", "Müşteri başarıyla düzenlendi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Müşteri düzenlenirken bir hata oluştu!", "error");
        }
        return Helper::redirectBackWith("statu", Session::get("statu"));
    }

    public function delete()
    {
        if (!$_POST) {
            return Helper::redirect();
        }

        $id = Helper::cleaner($_POST["id"]);
        $delete = $this->model("Customer")->delete($id);
        if ($delete) {
            Helper::flashData("statu", "Başarılı", "Müşteri başarıyla silindi!", "success");
        } else {
            Helper::flashData("statu", "Başarısız", "Müşteri silinirken bir hata oluştu!", "error");
        }

        return Helper::redirectBackWith("statu", Session::get("statu"));
    }
}
