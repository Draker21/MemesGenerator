<?php

class PageController extends Controller {
/* $recentMeme = Meme::displayLastGeneratedMeme(); */
    public function index(){
        

        
        $template = $this->twig->loadTemplate('/Page/index.html.twig');
        echo $template->render(array());
    }
}