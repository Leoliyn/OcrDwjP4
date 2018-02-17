<?php

require_once('model/frontend/PostManager.php');
require_once('model/frontend/CommentManager.php');
require_once('model/frontend/BookManager.php');
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
    $bookManager = new OpenClassrooms\DWJP4\frontend\Model\BookManager();
    $posts = $postManager->getPostsResume();
    $books = $bookManager->getBooks();
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
    
 function message($mailExpediteur,$participant){
$mail = 'webmaster@lionelclaudey.com'; // Adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = " Message site internet Jean FORTEROCHE  Participation dedicace : ".$participant." adresse mail de contact :".$mailExpediteur;
$message_html = "<html><head></head><body><b>Message site internet Jean FORTEROCHE</b>, Participation dedicace : ".$participant." adresse mail de contact :".$mailExpediteur."</body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Participation dedicace !";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"webmaster@lionelclaudey.com\"<webmaster@lionelclaudey.com>".$passage_ligne;
$header.= "Reply-to: \"webmaster@lionelclaudey.com\"<webmaster@lionelclaudey.com>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);

//==========
}   
    
    
    
    