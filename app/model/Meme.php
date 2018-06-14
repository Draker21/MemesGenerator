<?php

Class Meme{

    public static function displayLastGeneratedMeme() {
        $db = Database::getInstance();
        $sql = 'SELECT mem_pseudo, mem_image, mem_createdAt FROM `meme` ORDER BY mem_createdAt ASC LIMIT 5;';
        $stmt = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }

    public static function displayGalleryOfMeme() {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM `meme` ORDER BY mem_createdAt ASC;';
        $stmt = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }
    
}