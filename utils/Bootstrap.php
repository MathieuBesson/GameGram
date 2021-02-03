<?php
// Bootsrap const
define('INFO', 'info');
define('SUCCESS', 'success');
define('PRIMARY', 'primary');
define('SECONDARY', 'secondary');
define('DANGER', 'danger');
define('WARNING', 'warning');
define('LIGHT', 'light');
define('DARK', 'dark');
define('LINK', 'link');

define('BTN', 'btn');
define('FORM_LABEL', 'form-label');
define('FORM_CONTROL', 'form-control');
define('BADGE', 'badge');
define('BG', 'bg');
define('ALERT', 'alert');



class Bootsrap
{

    private string $pageName;
    private string $metaDescription;
    private string $lang;
    private array $menuLinks;
    private bool $displayResearch = false;


    public function __construct($pageName, $metaDescription, $lang)
    {
        $this->pageName = $pageName;
        $this->metaDescription = $metaDescription;
        $this->lang = $lang;
    }


    public function startDOM(): string
    {
        return '
            <!doctype html>
            <html lang="' . $this->lang . '">
            
            <head>
                <meta charset="' . $this->lang . '">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>' . APP_NAME . ' - ' . $this->pageName . '</title>
                <meta name="description" content="' . $this->metaDescription . '">
            
                <!-- Bootstrap core CSS -->
                <link href="' . DIR_CSS . 'bootstrap.css" rel="stylesheet">
            
                <!-- Custom styles for this template -->
                <link href="' . DIR_CSS . 'theme.css" rel="stylesheet">
            </head>
            
            <body>
        ';
    }

    public function endDOM(): string
    {
        return '
                <!-- Javascript files -->
                <script src="' . DIR_JS . 'bootstrap.js"></script>
                <script src="' . DIR_JS . 'main.js"></script>
            
            </body>
            </html>
        ';
    }

    public function startMain(): string
    {
        return '<main class="container">'. Http::getAlert();
    }

    public function endMain(): string
    {
        return '</main>';
    }

    public function menu(): string
    {
        $HTMLlinks = '';
        foreach ($this->menuLinks as $link) {
            $HTMLlinks .= '
                <li class="nav-item">
                    <a class="nav-link" href="' . $link['fileName'] . '">' . $link['content'] . '</a>
                </li>
            ';
        }

        return '
            <nav class="navbar navbar-expand-md navbar-dark bg-' . WARNING . '">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">GameGram</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">'
            . $HTMLlinks .
            '</ul>'  . ($this->displayResearch ? $this->researchHTML() : '') .
            '</div>
                </div>
            </nav>';
    }


    public function researchHTML(): string
    {
        return '
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Rechercher un jeu" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>
        ';
    }


    public function button($content, $link, $class = []): string
    {
        $color = $class['color'] ?? 'primary';
        return '<a class="' . BTN . ' ' . BTN . '-' . $color . '" href="' . $link . '">' . $content . '</a>';
    }

    public function badge($content, $class = []): string
    {
        $color = $class['color'] ?? 'primary';
        return '<span class="' . BADGE . ' ' . BG . '-' . $color . '">' . $content . '</span>';
    }


    public function alert($content, $options = []): string
    {
        $alert = new BootstrapAlert($content, $options);
        return $alert->alert();
    }



    public function image($fileName, $options = []): string
    {
        $alt = $options['alt'] ?? 'Une image du site Gamegram';
        $width = $options['width'] ?? "65%";
        $class = "img-fluid ";

        $class .= $options['class'] ?? "";

        return '<img class="' . $class . '" src="' . DIR_IMG . $fileName . '" alt="' . $alt . '" width="' . $width . '" />';
    }

    public function addMenu($content, $fileName): void
    {
        $this->menuLinks[] = ['content' => $content, 'fileName' => $fileName];
    }


    public function setDisplayResearch($bool): void
    {
        $this->displayResearch = $bool;
    }
}
