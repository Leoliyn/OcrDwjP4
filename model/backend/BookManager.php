<?php

namespace OpenClassrooms\DWJP4\backend\Model;

require_once("model/backend/Manager.php");

class bookManager extends Manager
{
   
    public function getBooks()
    {
        
        $db = $this->dbConnect();
        $req = $db->query('SELECT OUV_ID, OUV_TITRE,OUV_PREFACE,OUV_SOUSTITRE,OUV_AUTEUR,OUV_DESCRIPTION,OUV_KEYWORDS,OUV_ENABLE FROM ouvrage WHERE OUV_ENABLE=1');

        return $req;
    }

//       
    
    public function getBook($bookId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT OUV_ID, OUV_TITRE,OUV_PREFACE,OUV_SOUSTITRE,OUV_AUTEUR,OUV_DESCRIPTION,OUV_KEYWORDS,OUV_ENABLE FROM posts WHERE OUV_ID = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
    
public function addBook($title,$preface,$subtitle,$auteur,$description,$keywords,$enable)
    {
    
   
    $db = $this->dbConnect();
    $req = $db->prepare('INSERT into ouvrage (OUV_TITRE,OUV_PREFACE,OUV_SOUSTITRE,OUV_AUTEUR,OUV_DESCRIPTION,OUV_KEYWORDS,OUV_ENABLE) VALUES(?,?,?,?,?,?)');
    $req->execute(array( $title,$preface,$subtitle,$auteur,$description,$keywords,$enable)); 
    return $req;     
     
    }
    
    public function delBook($id)
    {
    $db = $this->dbConnect();
    $req = $db->prepare('DELETE FROM ouvrage WHERE OUV_ID = ?');
   
    $req->execute(array($id));  
  
  return $req;     
        
    }
    public function updateBook($title,$preface,$subtitle,$auteur,$description,$keywords,$enable,$id)
    {
 
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE ouvrage SET  OUV_TITRE=?,OUV_PREFACE=?,OUV_SOUSTITRE=?,OUV_AUTEUR=?,OUV_DESCRIPTION=?,OUV_KEYWORDS=?,OUV_ENABLE=? WHERE OUV_ID= ?');
    $req->execute(array( $title,$preface,$subtitle,$auteur,$description,$keywords,$enable,$id));     
        
    }
    public function enableBook($id)
    {
    
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE ouvrage SET  ART_ENABLE = ? WHERE OUV_ID= ?');
    $req->execute(array( 1,$id));        
     return $req;   
    }
    
    public function disableBook($id)
    {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE ouvrage SET  ART_ENABLE = ? WHERE OUV_ID= ?');
    $req->execute(array( 0,$id));        
    return $req;    
    }
    
}
