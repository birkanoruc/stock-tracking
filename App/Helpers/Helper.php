<?php

namespace App\Helpers;

use App\Helpers\Session;

class Helper
{
    public static function redirect($url = null)
    {
        $redirectUrl = $_ENV['SITE_URL'];

        if ($url !== null) {
            $redirectUrl .= $url;
        }

        if (!headers_sent()) {
            header("Location: " . $redirectUrl);
        } else {
            echo '<script>location.href="' . $redirectUrl . '";</script>';
        }
        exit;
    }

    public static function route($url)
    {
        return $_ENV['SITE_URL'] . $url;
    }

    public static function redirectBackWith(string $key, $data): void
    {
        self::with($key, $data);

        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: " . $_ENV['SITE_URL']);
        }
        exit;
    }

    public static function with(string $key, $data): void
    {
        Session::flash($key, $data);
    }

    static function cleaner($text)
    {
        $array = array("insert", "update", "union", "select", "*");
        $text = str_replace($array, '', $text);
        $text = strip_tags($text);
        $text = trim($text);
        return $text;
    }

    static function flashData($key, $title, $text, $type)
    {
        $value = array("title" => $title, "text" => $text, "type" => $type);
        Session::flash($key, $value);
    }

    static function flashDataView($key)
    {
        if (Session::has($key)) {
            $result = Session::get($key);
            Session::unflash($key);
            return $result;
        };
    }
}
