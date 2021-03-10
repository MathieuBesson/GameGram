<?php 

class Router
{
    public static function urlView($folder = '', $page = '', $options = []){

        $url = 'index.php';
        if($folder === '' || $page === ''){
            return $url;
        }

        $params = '';
        foreach($options as $key => $option){
            $params .= '&' . $key . '=' . $option;
        }

        $url .= '?dir=' . $folder . '&page='. $page . $params;

        return $url;
    }

    public static function urlProcess($folder, $page, $options = [])
    {

        $url = 'process.php';

        $params = '';
        foreach($options as $key => $option){
            $params .= '&' . $key . '=' . $option;
        }

        $url .= '?dir=' . $folder . '&page='. $page . $params;

        return $url;
    }

    public static function controlFile($dir, $file, $extension = 'php')
    {
        if(!file_exists($dir . $file . '.' . $extension)){
            die('Routing [001] : ' . $file . ' inexistant');
        }
    }

    public static function controlMethod($class, $method)
    {
        if(!method_exists($class, $method)){
            die('Routing [002] : ' . $method . ' inexistante');
        }
    }

    public static function get($key, $callback = '')
    {
        if (!Router::check($key)) {
            die('Routing [003] : ' . $key . ' n\'est pas bien renseigné');
        }
        
        if ($callback !== '' && !$callback($_GET[$key])) {
            die('Routing [004] : Mauvais format de ' . $key);
        }

        return $_GET[$key];
    }


    public static function check($name)
    {
        return isset($_GET[$name]);
    }

}