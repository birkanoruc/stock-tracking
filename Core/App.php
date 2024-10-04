<?php

namespace Core;

use Exception;

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // URL verilerini ayrıştır
        $url = $this->parseUrl();

        // Controller'ı yükle
        $this->loadController($url);

        // Metodu yükle
        $this->loadMethod($url);

        // Yöntemi parametrelerle birlikte çalıştır
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * URL'yi ayrıştırır ve temizler.
     * 
     * @return array URL parçalarını içeren dizi
     */
    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [$this->controller, $this->method]; // Eğer URL yoksa varsayılan controller ve metod
    }

    /**
     * Controller dosyasını yükler ve örneğini oluşturur.
     * 
     * @param array $url URL'den gelen parçalar
     */
    private function loadController($url)
    {
        $controllerFile = CONTROLLERS_PATH . "/" . ucfirst($url[0]) . "Controller.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerName = "App\\Controllers\\" . ucfirst($url[0]) . "Controller";
            if (class_exists($controllerName)) {
                $this->controller = new $controllerName();
            } else {
                throw new Exception("Controller sınıfı bulunamadı: " . $url[0]);
            }
        } else {
            throw new Exception("Controller dosyası bulunamadı: " . $url[0]);
        }
    }

    /**
     * Metodu yükler ve parametreleri ayarlar.
     * 
     * @param array $url URL'den gelen parçalar
     */
    /**
     * Metodu yükler ve parametreleri ayarlar.
     * 
     * @param array $url URL'den gelen parçalar
     */
    private function loadMethod(&$url)
    {
        // Eğer URL'nin ikinci elemanı varsa, metod ismi olarak ayarla
        if (isset($url[1])) {
            $methodName = $url[1];

            // Metod kontrolü
            if (method_exists($this->controller, $methodName)) {
                $this->method = $methodName;
                // Controller ve metod isimlerini URL'den çıkar
                array_shift($url); // Controller ismini çıkar
                array_shift($url); // Metod ismini çıkar
            } else {
                // get_class çağrısını controller nesnesine uygulayın
                throw new Exception("Method bulunamadı: " . $methodName);
            }
        }

        // URL'den kalan değerleri parametreler olarak ayarla
        $this->params = !empty($url) ? array_values($url) : [];
    }
}
