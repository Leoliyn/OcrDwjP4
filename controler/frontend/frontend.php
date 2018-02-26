<?php
//╔═════════════════════════════╗  
//           PROJET 4 DWJ OPENCLASSROOMS         
//           CLAUDEY Lionel Février 2018           
//╚═════════════════════════════╝
require_once('model/frontend/PostManager.php');
require_once('model/frontend/CommentManager.php');
require_once('model/frontend/BookManager.php');
// rewrite des url au format (indiqué dans htaccess) Non utilisée !
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


//╔════════════════════════════════════════╗  
//        List des chapitres depuis getPosts (uniquement publiés) 
//        - listPostsView
//╚════════════════════════════════════════╝
// 
function listPosts()
{
    $postManager = new OpenClassrooms\DWJP4\frontend\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

//╔════════════════════════════════════════════╗  
//      Liste de tous les chapitres depuis getPostsResume avec XX  
//      premiers caractères - Données de l'Ouvrage - listPostsView                                        
//╚════════════════════════════════════════════╝
// 
function listPostsResume()
{
    $postManager = new OpenClassrooms\DWJP4\frontend\Model\PostManager();
    $bookManager = new OpenClassrooms\DWJP4\frontend\Model\BookManager();
    $posts = $postManager->getPostsResume();
    $books = $bookManager->getBooks();
   require('view/frontend/listPostsView.php');
}
//╔════════════════════════════════════════╗  
//   Un chapitre  . Données Ouvrage - Les commentaires- req postView
//╚════════════════════════════════════════╝
// 
function post()
{
    $postManager = new OpenClassrooms\DWJP4\frontend\Model\PostManager();
    $commentManager = new OpenClassrooms\DWJP4\frontend\Model\CommentManager();
 $bookManager = new OpenClassrooms\DWJP4\frontend\Model\BookManager();
    $article = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
     $books = $bookManager->getBooks();
   $posts = $postManager->getPostsResume();
   
    require('view/frontend/postView.php');
}

//╔════════════════════════════════════════╗  
// active( le rend visible) le commentaire  - lance la fonction post()
//╚════════════════════════════════════════╝
// 
    
function activeSignal()
{
 $commentManager = new OpenClassrooms\DWJP4\frontend\Model\commentManager();
$comment = $commentManager->enableSignal($_GET['commId']);  
 post();
    
}
//╔════════════════════════════════════════╗  
//   désactive  le commentaire(invisible)  - lance la fonction post()
//╚════════════════════════════════════════╝
// 
function desactiveSignal()
{
  
$commentManager = new OpenClassrooms\DWJP4\frontend\Model\commentManager();
$comment = $commentManager->disableSignal($_GET['commId']);  
 post();
}   
//╔════════════════════════════════════════╗  
//   Ajoute un commentaire au chapitre puis lance la fonction post()
//╚════════════════════════════════════════╝
// 
function ajoutComment()
{
    
$commentManager = new OpenClassrooms\DWJP4\frontend\Model\commentManager();   
$comment = $commentManager->addComment($_GET['id'],$_POST['author'],$_POST['comment']);
post();    
}
//╔════════════════════════════════════════╗  
//   Fonction préparation puis envoi du courriel de contact
//     - lance le script modal.php
//╚════════════════════════════════════════╝
//    
 function message($nom,$mailExpediteur,$texte){
$mail = 'webmaster@lionelclaudey.com'; // Adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Définition du sujet.
$sujet = "Message Internaute pour Jean FORTEROCHE";

//=====Déclaration des messages au format texte 

$message_txt = "Message de :".$nom."  Adresse Mail : ".$mailExpediteur.$passage_ligne.$texte;
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
  
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

 //=====Envoi de l'e-mail.
if(mail($mail,$sujet,$message,$header)){
    $info ="Message envoyé";
 
}else {
 $info ="Message non envoyé réessayez plus tard !";   
  
}
return $info;

}   
 function infoMail($info){   
 require('view/frontend/modal.php');   
   
 }