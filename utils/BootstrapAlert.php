<?php 

class BootstrapAlert 
{
    private $text;
    private $options;

    public function __construct(string $text, array $options)
    {
        $this->text = $text;
        $this->options = $options;

    }


    public function alert(): string
    {
        $color = $this->options['color'] ?? DANGER;
        // $alertContent = $content;
        
        // if(isset($_SESSION[ALERT])){
        //     $alertContent = $_SESSION[ALERT]['message'];
        //     $color = $_SESSION[ALERT]['color'];
        //     Http::removeDataFromSession(ALERT);
        // } 
        $class = ALERT . ' ' . ALERT . '-' . $color . ' ';
        $class .= $this->options['class'] ?? DANGER;


        return '<div class="' . $class . '" role="' . ALERT . '">'
                    . $this->text .
                '</div>';
    }
}