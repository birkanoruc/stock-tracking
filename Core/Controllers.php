<?php

namespace Core;

use Exception;

class Controllers
{

    /**
     * Bir view dosyasını render eder.
     * 
     * @param string $file Görüntülenecek view dosyası.
     * @param array $params View içine aktarılacak parametreler.
     * @throws Exception
     */
    protected function render(string $file, array $params = []): void
    {
        $viewFile = VIEWS_PATH . "/" . $file . ".php";
        if (file_exists($viewFile)) {
            extract($params);
            require_once $viewFile;
        } else {
            throw new Exception("$file.php dosyası views içerisinde bulunamadı!");
        }
    }

    /**
     * Bir model dosyasını yükler.
     * 
     * @param string $file Yüklenecek model dosyası.
     * @return object Yüklenen model nesnesi.
     * @throws Exception
     */
    protected function model(string $file): object
    {
        $modelFile = MODELS_PATH . "/" . $file . ".php";
        if (file_exists($modelFile)) {
            require_once $modelFile;

            $className = "App\\Models\\" . $file;
            if (class_exists($className)) {
                return new $className();
            } else {
                throw new Exception("$modelFile dosyasında $file sınıfı bulunamadı!");
            }
        } else {
            throw new Exception("$file.php dosyası models dizininde bulunamadı!");
        }
    }
}
