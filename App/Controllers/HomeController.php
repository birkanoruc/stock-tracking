<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Pagination;
use App\Middlewares\Auth;

class HomeController extends Controllers
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
        $totalCustomer = $this->model("Customer")->totalCustomer();
        $totalProduct = $this->model("Product")->totalProduct();
        $totalInPrice = $this->model("Stock")->totalInPrice();
        $totalOutPrice = $this->model("Stock")->totalOutPrice();

        if ($_GET) {
            if ($_GET["search"] == null) {
                Helper::redirect();
            }
            Pagination::calculatePagination(count($this->model("Product")->search($_GET["search"])), 10);
            $search =  $this->model("Product")->search($_GET["search"], Pagination::$offset, Pagination::$limit);
            $pagination = Pagination::renderPagination("?search=" . $_GET["search"] . "&");
        } else {
            Pagination::calculatePagination(count($this->model("Product")->search()), 10);
            $search = $this->model("Product")->search();
            $pagination = Pagination::renderPagination();
        }


        $this->render("template-partials/header");
        $this->render("template-partials/app-header");
        $this->render("template-partials/app-sidebar");
        $this->render("home", ["totalCustomer" => $totalCustomer, "totalProduct" => $totalProduct, "totalInPrice" => $totalInPrice, "totalOutPrice" => $totalOutPrice, "search" => $search, "pagination" => $pagination]);
        $this->render("template-partials/footer");
    }
}
