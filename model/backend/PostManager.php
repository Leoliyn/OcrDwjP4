<?php
//╔═════════════════════════════╗  
//           PROJET 4 DWJ OPENCLASSROOMS         
//           CLAUDEY Lionel Février 2018           
//╚═════════════════════════════╝
//GESTION DES CHAPITRES  LISTE - AJOUTER- MODIFIER- SUPPRIMER -SUPPRIMER -ACTIVER- DESACTIVER
namespace OpenClassrooms\DWJP4\Backend\Model;
require_once("model/commun/Manager.php");
use OpenClassrooms\DWJP4\Commun\Model\Manager;

class PostManager extends Manager {

    //récupération du numéro de chapitre maximum
    public function getMaxChapter() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT MAX(ART_CHAPTER) FROM `posts` ');
        $chapter = $req->fetch();

        return $chapter;   
        
    }
    
    //recuperation des posts enable
    public function getPosts() {

        $db = $this->dbConnect();
        $req = $db->query('SELECT ART_ID, ART_CHAPTER,ART_TITLE,ART_SUBTITLE,ART_CONTENT, DATE_FORMAT(DATE, \'%d/%m/%Y à %Hh%imin%ss\') AS DATE_fr,ART_DESCRIPTION,ART_KEYWORDS,ART_IMAGE FROM posts WHERE ART_DESACTIVE = 0 ORDER BY ART_CHAPTER DESC ');

        return $req;
    }

    // recuperation des tous les posts  disable et enable
    public function getPostsResume() {
        $db = $this->dbConnect();

        $req = $db->query('SELECT ART_ID, LEFT(`ART_CONTENT`,300) AS ART_CONTENT,ART_CHAPTER,ART_TITLE,ART_SUBTITLE,
    DATE_FORMAT(DATE, \'%d/%m/%Y à %Hh%imin%ss\') AS DATE_fr,ART_DESACTIVE,ART_IMAGE, COUNT(comments.COMM_ARTID) AS NBCOMMENT FROM posts 
    LEFT JOIN comments ON posts.ART_ID = comments.COMM_ARTID group by posts.ART_TITLE ORDER BY ART_CHAPTER DESC ');

        return $req;
    }

    public function getPost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT ART_ID,ART_CHAPTER,ART_TITLE,ART_SUBTITLE,ART_CONTENT, ART_DESACTIVE,DATE_FORMAT(DATE, \'%d/%m/%Y à %Hh%imin%ss\') AS DATE_fr,ART_DESCRIPTION,ART_KEYWORDS,ART_IMAGE FROM posts WHERE ART_ID = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function addPost($chapter, $title, $subtitle, $content, $description, $keywords) {

        $date = (new \DateTime())->format('Y-m-d H:i:s');
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT into posts (ART_CHAPTER,ART_TITLE,ART_SUBTITLE,ART_CONTENT,DATE,ART_DESACTIVE,ART_DESCRIPTION,ART_KEYWORDS) VALUES(?,?,?,?,?,?,?,?)');
        $req->execute(array($chapter, $title, $subtitle, $content, $date, 1, $description, $keywords));
        $lastId = $db->lastInsertId();
        return $lastId;
    }

    public function addPostImg($image) {


        $db = $this->dbConnect();
        $req = $db->prepare('INSERT into posts (ART_CHAPTER,ART_TITLE,ART_SUBTITLE,ART_CONTENT,DATE,ART_DESACTIVE,ART_DESCRIPTION,ART_KEYWORDS,ART_IMAGE) VALUES(?,?,?,?,?,?,?,?,?)');
        $req->execute(array($chapter, $title, $subtitle, $content, $date, 1, $description, $keywords, $image));
        $lastId = $db->lastInsertId();
        return $lastId;
    }

    public function delPost($id) {
        $db = $this->dbConnect();
        $req0 = $db->prepare('SELECT ART_IMAGE FROM posts WHERE ART_ID = ?');
        $req0->execute(array($id));
        $image = $req0->fetch();
        //////////Suppression de l'mage associée///////////
        $dossier_traite = "uploads";
        $fichier = $image['ART_IMAGE'];
        $chemin = $dossier_traite . "/" . $fichier; // On définit le chemin du fichier à effacer.
        $repertoire = opendir($dossier_traite);
        if (file_exists($chemin)) {
            if (!is_dir($chemin)) {

                unlink($chemin); // On efface.
            }
        }
        closedir($repertoire);
        $req = $db->prepare('DELETE FROM posts WHERE ART_ID = ?');
        $req2 = $db->prepare('DELETE FROM comments WHERE COMM_ARTID = ?');
        $req->execute(array($id));
        $req2->execute(array($id));

        return $req;
    }

    public function updatePostImage($image, $id) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET  ART_IMAGE=? WHERE ART_ID= ?');
        $req->execute(array($image, $id));
    }

    public function updatePost($chapter, $title, $subtitle, $content, $disable, $id, $description, $keywords, $image) {
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET  ART_CHAPTER =?,ART_TITLE=?,ART_SUBTITLE=?,ART_CONTENT=?, DATE= ?,ART_DESACTIVE =?,ART_DESCRIPTION= ?,ART_KEYWORDS=?,ART_IMAGE=? WHERE ART_ID= ?');
        $req->execute(array($chapter, $title, $subtitle, $content, $date, $disable, $description, $keywords, $image, $id));
        $lastId = $db->lastInsertId();
        return $req;
    }

    public function enablePost($id) {
        $activ = 0;
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET  ART_DESACTIVE = ? WHERE ART_ID= ?');
        $req->execute(array($activ, $id));
        return $req;
    }

    public function disablePost($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET  ART_DESACTIVE = ? WHERE ART_ID= ?');
        $req->execute(array(1, $id));
        return $req;
    }

}
