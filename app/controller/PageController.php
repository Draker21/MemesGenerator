<?php

class PageController extends Controller {
    public function index(){
        $limit = $this->route['params']["limit"];
        $recentMeme = Meme::displayLastGeneratedMeme($limit);

        $template = $this->twig->loadTemplate('/Page/index.html.twig');
        echo $template->render(array(
            'meme' => $recentMeme
        ));
    }
} 