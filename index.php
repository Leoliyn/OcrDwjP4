<?php
session_start();
ini_set('display_errors', 1);
require_once  'controler/frontend/frontend.php'; 
if(isset($_GET['action'])AND ($_GET['action']=='post')AND (isset($_GET['id'])))
        {
      post();
}elseif(isset($_GET['action'])AND ($_GET['action']=='addComment') AND (isset($_GET['id']))){
    if(empty($_POST['author'])|| empty($_POST['comment'])){
        post();
    }else{
    ajoutComment();
     }
} elseif(isset($_GET['action'])AND ($_GET['action']=='enableSignal')AND (isset($_GET['id'])))
        {
            activeSignal();
         }
    
else{
      
        listPostsResume();        
        }




