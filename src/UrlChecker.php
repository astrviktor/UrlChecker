<?php
namespace Astrviktor\Tools\Url;


// класс для проверки работоспособности url
class UrlChecker
{
    // массив url адресов
    protected $urls;

    // Конструктор со списком url
    public function __construct($urls)
    {
        $this->urls = $urls;
    }

    public function getUrls()
    {
        return $this->urls;
    }

    // возвращает массив url со статусами
    public function getStatusUrls()
    {
        $statusUrls = [];

        foreach ($this->urls as $url)
        {

            $status = $this->getStatusUrl($url);

            array_push( $statusUrls, array(
                        'url' => $url,
                        'status' => $status
                    )
                );
         }

        return $statusUrls;

    }

    // Возвращает статус для url
    protected function getStatusUrl($url)
    {

        if(!$url) return "Страница не работает";

        $title = "";

        @$page = file_get_contents($url);

        if ($page) {
          if (preg_match("~<title>(.*?)</title>~iu", $page, $out)) {
            $title = $out[1];   
          }
        }

        if ($title) { 
            return "Страница работает";  
        } else {  
            return "Страница не работает";        
        }

    }

}