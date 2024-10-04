<?php

namespace App\Controllers;

use Core\Controllers;
use App\Helpers\Helper;
use App\Helpers\Session;
use App\Middlewares\Auth;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controllers
{
    public function __construct()
    {
        $authMiddleware = new Auth;
        if (!$authMiddleware->isLogged()) {
            Helper::redirect("/auth/login");
            die();
        }
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle("Ürünler");
        $sheet->setCellValue("A1", "id");
        $sheet->setCellValue("B1", "name");
        $sheet->setCellValue("C1", "category_id");
        $sheet->setCellValue("D1", "attributes");
        $sheet->setCellValue("E1", "date");
        $sheet->setCellValue("F1", "Kategori Adı");
        $sheet->setCellValue("G1", "Ürün Özellikleri");

        $product = $this->model("Product")->all();

        $i = 2;
        foreach ($product as $key => $value) {
            $category = $this->model("Category")->find($value["category_id"]);
            $attributes = $this->productAttributes(json_decode($value['attributes'], true));
            $sheet->setCellValue("A" . $i, $value["id"]);
            $sheet->setCellValue("B" . $i, $value["name"]);
            $sheet->setCellValue("C" . $i, $value["category_id"]);
            $sheet->setCellValue("D" . $i, $value["attributes"]);
            $sheet->setCellValue("E" . $i, $value["date"]);
            $sheet->setCellValue("F" . $i, $category["name"]);
            $sheet->setCellValue("G" . $i, $attributes);
            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = "Export/Product_Export_" . date("Y-m-d h-i-s") . ".xlsx";

        try {
            $writer->save($filename);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filename));
            readfile($filename);
            Helper::flashData("statu", "Başarılı", "Ürünler başarıyla dışa aktarıldı!", "success");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        } catch (Exception $e) {
            Helper::flashData("statu", "Başarısız", "Ürünler dışa aktarılırken bir hata oluştu! Error: {$e->getMessage()}", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }
    }

    public function productAttributes($array = [])
    {
        $returnArray = [];
        foreach ($array as $key => $value) {
            $returnArray[] = $value['name'] . ":" . $value['value'];
        }
        return implode(',', $returnArray);
    }

    public function import()
    {
        $name = $_FILES["file"]["name"];
        $full_path = $_FILES["file"]["full_path"];
        $tmp_name = $_FILES["file"]["tmp_name"];
        $type = $_FILES["file"]["type"];
        $error = $_FILES["file"]["error"];
        $size =  $_FILES["file"]["size"];

        $spreadsheet = new Spreadsheet();

        try {
            $spreadsheet = IOFactory::load($tmp_name);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet = $worksheet->removeRow(1);
            $columns = ['B', 'C', 'D', 'E'];

            foreach ($worksheet->getRowIterator() as $row) {
                $rowData = [];
                foreach ($columns as $column) {
                    $cellValue = $worksheet->getCell($column . $row->getRowIndex())->getValue();
                    $rowData[$row->getRowIndex()][$column] = $cellValue;
                }

                extract($rowData[$row->getRowIndex()]);
                $return[] = $this->model("Product")->create($B, $C, $D, $E);
            }

            $containsZero = in_array(0, $return);
            if ($containsZero) {
                Helper::flashData("statu", "Başarısız", "Ürünler içe aktarılırken bir hata oluştu!", "error");
            } else {
                Helper::flashData("statu", "Başarılı", "Ürünler başarıyla içe aktarıldı!", "success");
            }
            return Helper::redirectBackWith("statu", Session::get("statu"));
        } catch (Exception $e) {
            Helper::flashData("statu", "Başarısız", "Dosya okunamadı. Hata: {$e->getMessage()}", "error");
            return Helper::redirectBackWith("statu", Session::get("statu"));
        }
    }
}
