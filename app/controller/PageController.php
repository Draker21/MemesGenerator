<?php

class PageController extends Controller {
    public function index(){

        //Check les erreurs lors de l'upload
        $msg = array(); //Créer un tableau pour les messages d'erreurs
        $nb_error = 0;
        
        if(!empty($_FILES) && $_POST["submit"]){
            if(isset($_FILES['img']['error'])){
                switch($_FILES['img']['error']){ //ref : http://php.net/manual/fr/features.file-upload.errors.php
                    case 1:
                        $msg['msg'] = "Votre fichier ne doit pas dépasser 12Mo";
                        $msg['type'] = "error";
                        $nb_error++;
                        break;
                    case 2:
                        $msg['msg'] = "Votre fichier ne doit pas dépasser 12Mo";
                        $msg['type'] = "error";
                        $nb_error++;
                        break;
                    case 3:
                        $msg['msg'] = "Une erreur est survenue lors du téléchargement";
                        $msg['type'] = "error";
                        $nb_error++;
                        break;
                    case 4:
                        $msg['msg'] = "Veuillez sélectionner un fichier";
                        $msg['type'] = "error";
                        $nb_error++;
                        break;
                }
            }
        }

        if($nb_error = 0){ //Si aucune erreur 
            header("Content-type: image/jpeg"); //Définit une image/jpeg dans l'en-tête 
            header("Content-type: image/png"); //Définit une image/png dans l'en-tête 
            header("Content-type: image/gif"); //Définit une image/gif dans l'en-tête

            //Définir extensions autorisées
            //Créer image selon extensions
            //Envoyer l'image où l'on veut et libérer la mémoire
            //message de succès ou d'échec
        }

        $limit = $this->route['params']["limit"];
        $recentMeme = Meme::displayLastGeneratedMeme($limit);

        $template = $this->twig->loadTemplate('/Page/index.html.twig');
        echo $template->render(array(
            'meme' => $recentMeme
        ));
    }
}