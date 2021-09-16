<?php

class Renderer {
    public static function render(string $template, array $content = []):string {

        $template = "app/templates/_".$template.".phtml";
        ob_start();
        require $template;
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}