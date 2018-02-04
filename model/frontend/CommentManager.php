<?php

namespace OpenClassrooms\DWJP4\frontend\Model;

require_once("model/frontend/Manager.php");


class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT COMM_ID,COMM_ARTID,COMM_PSEUDO,COMM_TITRE,COMM_CONTENU,SIGNALE,DISABLE, DATE_FORMAT(COMM_DATE, \'%d/%m/%Y à %Hh%imin%ss\') AS COMM_date_fr FROM comments WHERE COMM_ARTID = ? ORDER BY COMM_DATE DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function addComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $comment->execute(array($commentId));

        return $comment;
    }
    

    
    
    
   public function enableSignal($commId)
    {
     $db = $this->dbConnect();
        $reqcomment = $db->prepare('UPDATE comments SET  SIGNALE = ?  WHERE COMM_ID =  ?');
        $reqcomment->execute(array( 1, $commId));

        return $reqcomment;
        
        
    } 
  
    
    public function disableSignal($commId)
    {
     $db = $this->dbConnect();
        $reqcomment = $db->prepare('UPDATE comments SET  SIGNALE = ?  WHERE COMM_ID = ?');
        $reqcomment->execute(array( 0, $commId));

        return $reqcomment;
        
    
}
}