<?php

require_once('model/frontend/PostManager.php');
require_once('model/frontend/CommentManager.php');

// rewrite des url au format (indiqué dans htaccess)
function urlRewrite($url){
/*$url = "index.php?action=post&id=20&titre=azerty&chapitre=5";*/
$tab_url = explode("?", $url);
$param = explode("&",$tab_url[1]);
$action=explode('=',$param[0]);
$id= explode('=',$param[1]);
$titre= explode('=',$param[2]);
$chapitre = explode('=',$param[3]);

$url2=$action[1].$id[1]."-chapitre".$chapitre[1]."-".$titre[1].".html";
return $url2;
}

// List des chapitres depuis getPosts (uniquement publiés)
function listPosts()
{
    $postManager = new OpenClassrooms\DWJP4\frontend\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}


function listPostsResume()
{
    $postManager = new OpenClassrooms\DWJP4\frontend\Model\PostManager();
    $posts = $postManager->getPostsResume();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new OpenClassrooms\DWJP4\frontend\Model\PostManager();
    $commentManager = new OpenClassrooms\DWJP4\frontend\Model\CommentManager();

    $article = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
   $posts = $postManager->getPostsResume();
    require('view/frontend/postView.php');
}


    
function activeSignal()
{
 $commentManager = new OpenClassrooms\DWJP4\frontend\Model\commentManager();
$comment = $commentManager->enableSignal($_GET['commId']);  
 post();
    
    
}
function desactiveSignal()
{
  
$commentManager = new OpenClassrooms\DWJP4\frontend\Model\commentManager();
$comment = $commentManager->disableSignal($_GET['commId']);  
 post();
}   

function ajoutComment()
{
    
$commentManager = new OpenClassrooms\DWJP4\frontend\Model\commentManager();   
$comment = $commentManager->addComment($_GET['id'],$_POST['author'],$_POST['comment']);
post();    
}
    
    
    
    
    
    