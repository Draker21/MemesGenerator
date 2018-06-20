<?php

class PageController extends Controller {
    public function index(){

        //Check les erreurs lors de l'upload
        $msg = array(); //Créer un tableau pour les messages d'erreurs
        $nb_error = 0;
        
        if(!empty($_FILES)){
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


            if($nb_error = 0){ //Si aucune erreur 
                /* header("Content-type: image/jpeg"); //Définit une image/jpeg dans l'en-tête 
                header("Content-type: image/png"); //Définit une image/png dans l'en-tête 
                header("Content-type: image/gif"); //Définit une image/gif dans l'en-tête */
                $ext = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF']; // Création d'une liste blanche des extensions autorisées
                $fichier_upload = $_FILES['file-input'];
               
                if(in_array($ext, pathinfo($fichier_upload['name'],PATHINFO_EXTENSION))){ //Rennome l'img
                    $imgName = 'mg_'.md5($fichier_upload).microtime().'.'.$ext;

                    $tmpName = $_FILES["img"]["tmp_name"]; //Chemin temporaire de l'image
                    $dir = (ROOT.'\app\assets\img_generated/' . $imgName); // Envoie l'image

                    //Tableau des extensions
                    $arrayJpg = array('jpg', 'JPG', 'jpeg', 'JPEG');
                    $arrayPng = array('png', 'PNG');
                    $arrayGif = array('gif', 'GIF');

                        if(in_array($ext,$arrayJpg)){
                            $im = imagecreatefromjpeg($tmpName);
                        }elseif(in_array($ext,$arrayPng)){
                            $im = imagecreatefrompng($tmpName);
                        }elseif(in_array($ext,$arrayGif)){
                            $im = imagecreatefromgif($tmpName);
                        } else {
                            $msg['msg'] = "Format incorrect. Veuillez choisir une image PNG, JPG ou GIF.";
                            $msg['type'] = "error";
                        }

                    }
                
                
                    if(isset($_POST['submit'])){
                        if(in_array($ext, $array_jpg)){
                            imagejpeg($im,$dir);
                            
                        } elseif(in_array($ext, $array_gif)){
                            imagegif($im,$dir);
                           
                        } elseif(in_array($ext, $array_png)){
                            imagepng($im,$dir);
                           
                        } else { 
                            $msg['msg'] = "Impossible de crée votre meme, veuillez changer le type de fichier";
                            $msg['type'] = "error";
                        }  
                    }
                    imagedestroy($im);
                    $msg['msg'] = "Votre image a bien été upload.";
                    $msg['type'] = 'success';
                } else {
                $msg['msg'] = 'Extension de fichier non pris en compte.';
                $msg['type'] = 'error';
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