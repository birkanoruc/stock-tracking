<?php

namespace App\Helpers;

class Pagination
{
    static $currentPage;
    static $totalPage;
    static $offset;
    static $limit = 10;
    static $count;

    static function calculatePagination($count, $limit)
    {
        self::$limit = $limit;
        self::$count = $count;
        self::$totalPage = ceil($count / $limit);
        if (!empty($_GET["page"])) {
            self::$currentPage = intval($_GET["page"]);
            if (self::$currentPage > self::$totalPage || self::$currentPage <= 0) {
                self::$currentPage = 1;
            }
        } else {
            self::$currentPage = 1;
        }
        self::$offset = (self::$currentPage - 1) * $limit;
    }

    static function renderPagination($pname = '?')
    {
        $pagerArray = [];
        if (self::$totalPage > 1) {
            $pagerArray[] = '<div class="card-body row">';
            $pagerArray[] = '<div class="col-xl-6">';
            $pagerArray[] = '<span>' . self::$count . ' kayıt içerisinden ' . self::$offset + 1 . ' - ' . self::$offset + self::$limit . ' aralığındaki kayıtlar gösteriliyor!</span>';
            $pagerArray[] = '</div>';
            $pagerArray[] = '<div class="col-xl-6">';
            $pagerArray[] = '<ul class="pagination  d-flex justify-content-end">';
            if (self::$currentPage == 1) {
                $pagerArray[] = '<li class="page-item page-prev disabled"><a class="page-link" href="' . $pname . 'page=' . 1 . '"><<</a></li>';
                $pagerArray[] = '<li class="page-item page-prev disabled"><a class="page-link" href="' . $pname . 'page=' . 1 . '">Önceki</a></li>';
            } else {
                $pagerArray[] = '<li class="page-item page-prev"><a class="page-link" href="' . $pname . 'page=' . 1 . '"><<</a></li>';
                $pagerArray[] = '<li class="page-item page-prev"><a class="page-link" href="' . $pname . 'page=' . self::$currentPage - 1 . '">Önceki</a></li>';
            }

            $pagerArray[] = '<li class="page-item active"><a class="page-link" href="' . $pname . 'page=' . self::$currentPage . '">' . self::$currentPage . '</a></li>';

            if (self::$currentPage == self::$totalPage) {
                $pagerArray[] = '<li class="page-item page-next disabled"><a class="page-link" href="' . $pname . 'page=' . self::$totalPage . '">Sonraki</a></li>';
                $pagerArray[] = '<li class="page-item page-next disabled"><a class="page-link" href="' . $pname . 'page=' . self::$totalPage . '">>></a></li>';
            } else {
                $pagerArray[] = '<li class="page-item page-next"><a class="page-link" href="' . $pname . 'page=' . self::$currentPage + 1 . '">Sonraki</a></li>';
                $pagerArray[] = '<li class="page-item page-next"><a class="page-link" href="' . $pname . 'page=' . self::$totalPage . '">>></a></li>';
            }
            $pagerArray[] = '</ul></div></div>';
        }
        return $pagerArray;
    }
}
