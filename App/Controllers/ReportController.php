<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Pagination;
use App\Middlewares\Auth;

class ReportController extends Controllers
{

   public function __construct()
   {
      $authMiddleware = new Auth;
      if (!$authMiddleware->isLogged() && !$authMiddleware->isPermission(6)) {
         Helper::redirect("/auth/login");
         die();
      }
   }

   public function product()
   {
      Pagination::calculatePagination(count($this->model("Product")->all()), 10);
      $products =  $this->model("Product")->pagination(Pagination::$offset, Pagination::$limit);

      $this->render("template-partials/header");
      $this->render("template-partials/app-header");
      $this->render("template-partials/app-sidebar");
      $this->render("report/product/index", ["products" => $products, "pagination" => Pagination::renderPagination()]);
      $this->render("template-partials/footer");
   }

   public function customer()
   {
      Pagination::calculatePagination(count($this->model("Customer")->all()), 10);
      $customers =  $this->model("Customer")->pagination(Pagination::$offset, Pagination::$limit);

      $this->render("template-partials/header");
      $this->render("template-partials/app-header");
      $this->render("template-partials/app-sidebar");
      $this->render("report/customer/index", ["customers" => $customers, "pagination" => Pagination::renderPagination()]);
      $this->render("template-partials/footer");
   }

   public function cash()
   {
      Pagination::calculatePagination(count($this->model("Cash")->all()), 10);
      $cashs =  $this->model("Cash")->pagination(Pagination::$offset, Pagination::$limit);

      $this->render("template-partials/header");
      $this->render("template-partials/app-header");
      $this->render("template-partials/app-sidebar");
      $this->render("report/cash/index", ["cashs" => $cashs, "pagination" => Pagination::renderPagination()]);
      $this->render("template-partials/footer");
   }

   public function invoice()
   {
      Pagination::calculatePagination(count($this->model("Invoice")->all()), 10);
      $customers =  $this->model("Customer")->pagination(Pagination::$offset, Pagination::$limit);

      $this->render("template-partials/header");
      $this->render("template-partials/app-header");
      $this->render("template-partials/app-sidebar");
      $this->render("report/invoice/index", ["customers" => $customers, "pagination" => Pagination::renderPagination()]);
      $this->render("template-partials/footer");
   }

   public function date()
   {
      $startDate = $_GET["start_date"] ?? date("Y-m-01");
      $endDate = $_GET["end_date"] ?? date("Y-m-d");
      $totalRecords = count($this->model("Stock")->filter($startDate, $endDate));
      Pagination::calculatePagination($totalRecords, 10);
      $stocks = $this->model("Stock")->filter($startDate, $endDate, Pagination::$offset, Pagination::$limit);
      $queryString = http_build_query(['start_date' => $startDate, 'end_date' => $endDate]);
      $pagination = Pagination::renderPagination("?$queryString&");

      $this->render("template-partials/header");
      $this->render("template-partials/app-header");
      $this->render("template-partials/app-sidebar");
      $this->render("report/date/index", ["stocks" => $stocks, "pagination" => $pagination]);
      $this->render("template-partials/footer");
   }
}
