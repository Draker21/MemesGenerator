<?php

class PageController extends Controller {

    public function index(){
        $template = $this->twig->loadTemplate('/Page/index.html.twig');
        echo $template->render(array());
    }
}