<?php

Class Meme  {

    public static function displayLastGeneratedMeme() {
        $serveur ="localhost";
        $login = "root";
        $pass = "";
        $db = new PDO("mysql:host=$serveur;dbname=memegenerator",$login, $pass);
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM meme
        order by rand()  
        limit 3";
        $stmt = $db->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
        }

    public static function displayGalleryOfMeme() {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM `meme` ORDER BY mem_createdAt ASC;';
        $stmt = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }

    public static function test(){
        $serveur ="localhost";
        $login = "root";
        $pass = "";
        $db = new PDO("mysql:host=$serveur;dbname=memegenerator",$login, $pass);
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $db->prepare("
        SELECT * FROM meme
    ");
   
        $requete->execute();
        $tables = $requete->fetchAll();
        $donnee;
     
            
        foreach($tables as $table){ 
            $donnee=$table['mem_id'];
            $donnee2=$table['mem_pseudo'];
            $donnee3=$table['mem_image'];
            $donnee4=$table['mem_createdAt'];
            echo '<div class="d_flexcenter h20vh w30vh bgWhite">'.$donnee.'<br>'.$donnee2.'<br>'.$donnee3.'<br>'.$donnee4.'</div>';
        
            }        
        
           
    return $tables;



    }
    
}

/*
        global $db;
            
        $db = Database::getInstance();

$sql = 'SELECT mem_pseudo, mem_image, mem_createdAt FROM `meme` ORDER BY mem_createdAt ASC LIMIT 5';
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
return $stmt->fetchAll();*/