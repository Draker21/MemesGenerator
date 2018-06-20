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

                        //Variable pour le texte.
                    //Récupère la largeur et hauteur de l'image en cours
                    $image_width = imagesx($im);
                    $image_height = imagesy($im);
                    //Récupère les valeurs des blocs où on écrit
                    $text_top = strtoupper($_POST['textTop']);
                    $text_bot = strtoupper($_POST['textBot']);
                    //Rotation du texte
                    $rotation = 0;
                    //Margin
                    $top_margin = 60;
                    //Font family + font size
                    $font_size = 16;
                    $font = ROOT .'/app/assets/fonts/Roboto-Light.ttf';
                    //Couleur
                    $grey = imagecolorallocate($im, 128, 128, 128);
                    $red = imagecolorallocate($im, 255, 0, 0);
                    $white = imagecolorallocate($im, 255, 255, 255);
                    $black = imagecolorallocate($im, 0, 0, 0);
                    //Crée un rectangle qui entourera le texte.
                    $text_bound_top = imageftbbox($font_size, $rotation, $font, $text_top);
                    $text_bound_bot = imageftbbox($font_size, $rotation, $font, $text_bot);
                //Récupère les coordonnées des 4 coins du rectangle en X et Y
                    //top
                    $lower_left_x_top =  $text_bound_top[0]; 
                    $lower_left_y_top =  $text_bound_top[1];
                    $lower_right_x_top = $text_bound_top[2];
                    $lower_right_y_top = $text_bound_top[3];
                    $upper_right_x_top = $text_bound_top[4];
                    $upper_right_y_top = $text_bound_top[5];
                    $upper_left_x_top =  $text_bound_top[6];
                    $upper_left_y_top =  $text_bound_top[7];
                    //bot
                    $lower_left_x_bot =  $text_bound_bot[0]; 
                    $lower_left_y_bot =  $text_bound_bot[1];
                    $lower_right_x_bot = $text_bound_bot[2];
                    $lower_right_y_bot = $text_bound_bot[3];
                    $upper_right_x_bot = $text_bound_bot[4];
                    $upper_right_y_bot = $text_bound_bot[5];
                    $upper_left_x_bot =  $text_bound_bot[6];
                    $upper_left_y_bot =  $text_bound_bot[7];
                //Création du texte
                    //Récupère la largeur du texte et sa hauteur
                        //top
                        $text_width_top =  $lower_right_x_top - $lower_left_x_top;
                        $text_height_top = $lower_left_y_top - $upper_left_y_top; 
                        //bot
                        $text_width_bot =  $lower_right_x_bot - $lower_left_x_bot;
                        $text_height_bot = $lower_left_y_bot - $upper_left_y_bot; 
                    //Récupère la position ou le texte sera centré.
                    $start_x_offset_top = ($image_width - $text_width_top) / 2; //Centre Horizontalement le texte.
                    $start_y_offset_top = ($image_height - $text_height_top) / 2; //Centre verticalement le texte.
                    $start_x_offset_bot = ($image_width - $text_width_bot) / 2; //Centre Horizontalement le texte.
                    $start_y_offset_bot = ($image_height - $text_height_bot) / 2; //Centre verticalement le texte.
                    $start_end_offset = $image_height - 20; //Place le texte en bas - 20px de la hauteur de l'image.

//Param text top
                        //Contour
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top - 1.5, $top_margin - 1.5, $black, $font, $text_top);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top - 1.5, $top_margin + 2, $black, $font, $text_top);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top + 1.5, $top_margin - 2, $black, $font, $text_top);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top + 1.5, $top_margin + 1.5, $black, $font, $text_top);
                        //Text
                        imagettftext($im, $font_size, $rotation, $start_x_offset_top, $top_margin, $white, $font, $text_top);
                    //Param text bot
                        //Contour
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot - 1.5, $start_end_offset - 1.5, $black, $font, $text_bot);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot - 1.5, $start_end_offset + 2, $black, $font, $text_bot);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot + 1.5, $start_end_offset - 2, $black, $font, $text_bot);
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot + 1.5, $start_end_offset + 1.5, $black, $font, $text_bot);
                        //Text
                        imagettftext($im, $font_size, $rotation, $start_x_offset_bot, $start_end_offset, $white, $font, $text_bot);

                        
                    if(isset($_POST['submit'])){
                        if(in_array($imgExt, $arrayJpg)){
                            imagejpeg($im,$dir);
                        } elseif(in_array($imgExt, $arrayPng)){
                            imagepng($im,$dir);
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