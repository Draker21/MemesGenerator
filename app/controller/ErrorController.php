<?php
class ErrorController extends Controller {

    public function error404(){
        $template = $this->twig->loadTemplate('/Error/404.html.twig');
        echo $this->twig->render($template, array(
            
        ));
    }
}