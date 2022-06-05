<?php
namespace Traits;

trait TraitParseUrl{

    #Criar um array com a url digitada pelo usuário
    public static function parseUrl($param=null)
    {
        $url=explode("/",rtrim($_GET['url'],FILTER_SANITIZE_URL));
        if($param == null) {
            return $url;
        } else {
            return $url[$param];
        }

    }
}