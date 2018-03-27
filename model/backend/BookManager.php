<?php
//╔═════════════════════════════╗  
//           PROJET 4 DWJ OPENCLASSROOMS         
//           CLAUDEY Lionel Février 2018           
//╚═════════════════════════════╝
//GESTION DES OUVRAGES  LISTE - AJOUTER- MODIFIER- SUPPRIMER -SUPPRIMER -ACTIVER- DESACTIVER
namespace OpenClassrooms\DWJP4\backend\Model;
require_once("model/commun/Manager.php");
use OpenClassrooms\DWJP4\Commun\Model\Manager;

class BookManager extends Manager {

    public function getBooks() {

        $db = $this->dbConnect();
        $req = $db->query('SELECT OUV_ID, OUV_TITRE,OUV_PREFACE,OUV_SOUSTITRE,OUV_AUTEUR,OUV_DESCRIPTION,OUV_KEYWORDS,OUV_ENABLE FROM ouvrage WHERE OUV_ENABLE=1');

        return $req;
    }

    public function getBook($bookId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT OUV_ID, OUV_TITRE,OUV_PREFACE,OUV_SOUSTITRE,OUV_AUTEUR,OUV_DESCRIPTION,OUV_KEYWORDS,OUV_ENABLE FROM ouvrage WHERE OUV_ID = ?');
        $req->execute(array($bookId));
        $book = $req->fetch();

        return $book;
    }

    public function addBook($title, $preface, $subtitle, $auteur, $description, $keywords) {


        $db = $this->dbConnect();
        $req2 = $db->prepare('UPDATE ouvrage SET  OUV_ENABLE = ? WHERE 1');
        $req2->execute(array(0));
        $req = $db->prepare('INSERT into ouvrage (OUV_TITRE,OUV_PREFACE,OUV_SOUSTITRE,OUV_AUTEUR,OUV_DESCRIPTION,OUV_KEYWORDS,OUV_ENABLE) VALUES(?,?,?,?,?,?,?)');
        $req->execute(array($title, $preface, $subtitle, $auteur, $description, $keywords, 1));
        return $req;
    }

    public function delBook($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM ouvrage WHERE OUV_ID = ?');

        $req->execute(array($id));

        return $req;
    }

    public function updateBook($title, $preface, $subtitle, $auteur, $description, $keywords, $enable, $id) {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE ouvrage SET  OUV_TITRE=?,OUV_PREFACE=?,OUV_SOUSTITRE=?,OUV_AUTEUR=?,OUV_DESCRIPTION=?,OUV_KEYWORDS=?,OUV_ENABLE=? WHERE OUV_ID= ?');
        $req->execute(array($title, $preface, $subtitle, $auteur, $description, $keywords, $enable, $id));
    }

    public function enableBook($id) {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE ouvrage SET  OUV_ENABLE = 1 WHERE OUV_ID= ?');
        $req->execute(array($id));
        return $req;
    }

    public function disableBook($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE ouvrage SET  OUV_ENABLE = 0 WHERE OUV_ID= ?');
        $req->execute(array($id));
        return $req;
    }

}
