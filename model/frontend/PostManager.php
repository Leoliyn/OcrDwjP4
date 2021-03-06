<?php
//╔═════════════════════════════╗  
//           PROJET 4 DWJ OPENCLASSROOMS         
//           CLAUDEY Lionel Février 2018           
//╚═════════════════════════════╝
//GESTION DES CHAPITRES LISTE 
namespace OpenClassrooms\DWJP4\frontend\Model;
require_once("model/commun/Manager.php");
use OpenClassrooms\DWJP4\Commun\Model\Manager;

class PostManager extends Manager {

//recuperation des posts enable
    public function getPostsResume() {

        $db = $this->dbConnect();
        $req = $db->query('SELECT ART_ID, ART_CHAPTER,ART_TITLE,ART_SUBTITLE,SUBSTRING(ART_CONTENT,1,300) AS ART_CONTENT_RESUME, DATE_FORMAT(DATE, \'%d/%m/%Y à %Hh%imin%ss\') AS DATE_fr,ART_DESCRIPTION,ART_KEYWORDS,ART_IMAGE FROM posts WHERE ART_DESACTIVE = 0 ORDER BY ART_CHAPTER DESC ');
        return $req;
    }

    public function getPost($postId) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT ART_ID,ART_CHAPTER,ART_TITLE,ART_SUBTITLE,ART_CONTENT, ART_DESACTIVE,DATE_FORMAT(DATE, \'%d/%m/%Y à %Hh%imin%ss\') AS DATE_fr,ART_DESCRIPTION,ART_KEYWORDS,ART_IMAGE FROM posts WHERE ART_ID = ? AND ART_DESACTIVE = ?');
        $req->execute(array($postId,0));
        $post = $req->fetch();

        return $post;
    }

}
