<?php
define('METHOD_POST', 'post');
define('METHOD_GET', 'get');
define('METHODS', [METHOD_GET, METHOD_POST]);

define('TYPE_TEXT', 'text');
define('TYPE_EMAIL', 'email');
define('TYPE_PASSWORD', 'password');
define('TYPE_NUMBER', 'number');
define('TYPE_HIDDEN', 'hidden');

define('TYPES', [TYPE_TEXT, TYPE_EMAIL, TYPE_PASSWORD, TYPE_NUMBER, TYPE_HIDDEN]);



class BootstrapForm
{
    private string $action;
    private string $method;
    private string $name;

    private array $inputs = [];

    private array $submit = [];
    private string $HTMLAttributs;


    public function __construct($name, $action, $method = METHOD_POST)
    {
        if (!in_array($method, METHODS)) {
            die('Erreur fatale [BF 001]: Mauvaise configuration du formulaire !');
        }

        $this->name = $this->slugify($name);
        $this->action = $action;
        $this->method = $method;
    }

    public function addInput($name, $type, $options = [])
    {
        if (!in_array($type, TYPES)) {
            die('Erreur fatale [BF 002]: Mauvaise configuration du champ !');
        }
        $this->inputs[] = [
            'name' => $name,
            'type' => $type,
            'options' => $options
        ];
    }

    public function input($name, $type, $options = [])
    {
        $input = '<div class="mb-3">';
        $id = $this->slugify($this->name . ' ' . $name);
        $this->HTMLAttributs = '';

        if ($type !== TYPE_HIDDEN) {
            $this->handleHTMLAttributs($options, 'placeholder');
            $this->handleHTMLAttributs($options, 'value');
            $label = $options['label'] ?? $name;
            $input .= '<label for="' . $id . '" class="'. FORM_LABEL .'">' . $label . '</label>';
        }

        if ($type === TYPE_NUMBER) {
            $this->handleHTMLAttributs($options, 'step');
            $this->handleHTMLAttributs($options, 'min');
            $this->handleHTMLAttributs($options, 'max');
        }

        $input .= '<input type="' . $type . '" class="'. FORM_CONTROL .'" id="' . $id . '" name="' . $this->slugify($name) . '" ' . $this->HTMLAttributs . '/>'; 
        $input .= '</div>';

        return $input;
    }

    private function handleHTMLAttributs($options, $attributeName){
        $this->HTMLAttributs .= isset($options[$attributeName]) ? $attributeName . '="' . $options[$attributeName] . '" ' : '';
    }

    private function slugify($string)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9_]+/', '_', $string)));
    }

    public function setSubmit($name, $options = [])
    {
        $this->submit = [
            'name' => $name,
            'options' => $options
        ];
    }

    public function submit()
    {
        $color = $this->submit['options']['color'] ?? PRIMARY;
        return '<button type="submit" class="' . BTN . ' ' . BTN . '-' . $color . '">' . $this->submit['name'] . '</button>';
    }

    public function getForm()
    {

        $form = '<form method="' . $this->method . '" action="' . $this->action . '" class="w-25 m-5">';
        $form .= $this->input($this->name, TYPE_HIDDEN);

        foreach ($this->inputs as $input) {
            $form .= $this->input($input['name'], $input['type'], $input['options']);
        }

        $form .= $this->submit();

        $form .= '</form>';

        return $form;
    }
}
