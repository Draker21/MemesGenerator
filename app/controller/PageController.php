<?php

class PageController extends Controller {
    public function index(){

        //Check les erreurs lors de l'upload
        $msg = array(); //Créer un tableau pour les messages d'erreurs
        $nb_error = 0;
        if(!empty($_FILES)){
            if(isset($_FILES['imgUpload']['error'])){
                switch($_FILES['imgUpload']['error']){ //ref : http://php.net/manual/fr/features.file-upload.errors.php
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
            if($nb_error == 0){ //Si aucune erreur 
                $ext = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF']; // Création d'une liste blanche des extensions autorisées
                $imgExt = substr($_FILES['imgUpload']['name'], strrpos($_FILES['imgUpload']['name'], '.') + 1);

                if(in_array($imgExt, $ext)){ //Renomme l'img
                $imgExt = substr($_FILES['imgUpload']['name'], strrpos($_FILES['imgUpload']['name'], '.') + 1);
                    $imgName = 'mg_'.substr(md5($_FILES['imgUpload']['name']), 0, 5).microtime().'.'.$imgExt;

                    $tmpName = $_FILES["imgUpload"]["tmp_name"]; //Chemin temporaire de l'image
                    $dir = ROOT . '\app\assets\img_generated/' . $imgName; // Envoie l'image
                
                    //Tableau des extensions
                    $arrayJpg = array('jpg', 'JPG', 'jpeg', 'JPEG');
                    $arrayPng = array('png', 'PNG');
                    $arrayGif = array('gif', 'GIF');
                        if(in_array($imgExt,$arrayJpg)){
                            $im = imagecreatefromjpeg($tmpName);
                        }elseif(in_array($imgExt,$arrayPng)){
                            $im = imagecreatefrompng($tmpName);
                           
                        }elseif(in_array($imgExt,$arrayGif)){
                            $im = imagecreatefromgif($tmpName);
                        
                        } else {
                            $msg['msg'] = "Format incorrect. Veuillez choisir une image PNG, JPG ou GIF.";
                            $msg['type'] = "error";
                        }
                        print_r($im);

                    if(isset($_POST['submit'])){
                        echo 'Entrée';
                        if(in_array($imgExt, $arrayJpg)){
                            imagejpeg($im,$dir);
                        } elseif(in_array($imgExt, $arrayPng)){
                            imagepng($im,$dir);
                            echo "LOL 2";
                        } elseif(in_array($imgExt, $arrayGif)){
                            imagegif($im,$dir);
                        } else {
                            $msg['msg'] = "Impossible de crée votre meme, veuillez changer le type de fichier";
                            $msg['type'] = "error";
                        }  
                    }

                    imagedestroy($im);
                    $msg['msg'] = "Votre image a bien été upload.";
                    $msg['type'] = 'success';
                }
            }
        } 


        $limit = $this->route['params']["limit"];
        $recentMeme = Meme::displayLastGeneratedMeme($limit);

        $template = $this->twig->loadTemplate('/Page/index.html.twig');
        echo $template->render(array(
            'meme' => $recentMeme
        ));
    }
}