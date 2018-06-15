<?php

class PageController extends Controller {

    public function index(){
        
        $recentMeme = Meme::displayLastGeneratedMeme(); 
        $essaiaffiche = Meme::test();
        
        $template = $this->twig->loadTemplate('/Page/index.html.twig');
        echo $template->render(array(
            "affiche" => $essaiaffiche
        ));
    }
}