<?php

abstract class Http
{
    /**
     * Function redirect to specific url
     *
     * @param  string $url
     * @return void
     */
    public static function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit();
    }


    /**
     * Function set alert in session
     *
     * @param  string $message
     * @param  array $options
     * @return void
     */
    public static function setAlertToSession($message, $options = []): void
    {
        $_SESSION[ALERT] = [
            'message' => $message,
            'options' => $options
        ];
    }


    /**
     * Function who remove a data from session 
     *
     * @return void
     */
    public static function removeDataFromSession($key)
    {
        unset($_SESSION[$key]);
    }

    public static function getAlert()
    {
        if(!isset($_SESSION[ALERT])){
            return '';
        }


        $alert = new BootstrapAlert(
            $_SESSION[ALERT]['message'],
            $_SESSION[ALERT]['options']
        );

        Http::removeDataFromSession(ALERT);

        return $alert->alert();
    }
}
