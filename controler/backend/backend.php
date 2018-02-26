<?php
//╔═════════════════════════════╗  
//           PROJET 4 DWJ OPENCLASSROOMS         
//           CLAUDEY Lionel Février 2018           
//╚═════════════════════════════╝
require_once('model/backend/PostManager.php');
require_once('model/backend/CommentManager.php');
require_once('model/backend/UsersManager.php');
require_once('model/backend/BookManager.php');

function changePsswd()
{
    if((!empty($_POST['oldmdp']))AND(strlen($_POST['mdp'])>=6)){
 $userManager =  new OpenClassrooms\DWJP4\Backend\Model\UsersManager(); 
 $connexion = $userManager->connexion('admin',$_POST['oldmdp']);
 if($connexion >0){
 $user =$userManager -> updatePsswd($_POST['mdp']);
 $message ='Mot de passe enregistré.';   
 }else{
 $message ='Identifiant incorrects ou Réessayez plus tard! ';   
 }
 
    } 
    require ('view/backend/updatePasswdView.php');  
}
//╔════════════════════════════════════════╗  
//   Liste des ouvrages 
//╚════════════════════════════════════════╝
// 
function listOuvrages()
{
    $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
    $books = $bookManager->getBooks();

    require('view/backend/listBooksView.php');
}
//╔════════════════════════════════════════╗  
//   Liste des chapitres en résumé 
//╚════════════════════════════════════════╝
// 
function listPosts()
{
    $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
    $posts = $postManager->getPostsResume();

    require('view/backend/listPostsView.php');
}

//╔════════════════════════════════════════╗  
//   Liste des chapitres en résumé 
//╚════════════════════════════════════════╝
//
function listPostsResume()
{
    $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
    $posts = $postManager->getPostsResume();

    require('view/backend/listPostsView.php');
}

//╔════════════════════════════════════════╗  
//   Ouvrage depuis un ID
//╚════════════════════════════════════════╝
//
function book()
{
    $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
    $book = $bookManager->getBook($_GET['id']);
     require('view/backend/bookView.php');
      
}

//╔════════════════════════════════════════╗  
//   1 chapitre depuis ID + les commentaires de ce chapitre
//╚════════════════════════════════════════╝
//
function post()
{
    $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
    $commentManager = new OpenClassrooms\DWJP4\Backend\Model\CommentManager();

    $article = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
   
    require('view/backend/postView.php');
}
//╔════════════════════════════════════════╗  
//   1 chapitre depuis son ID - vue formulaire modification chapitre
//╚════════════════════════════════════════╝
//
function formModifyPost()
{
     $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
     $article = $postManager->getPost($_GET['id']);
    require('view/backend/updatePostView.php');
}

//╔══════════════════════════════════════════╗  
//   1 Ouvrage depuis son ID - vue formulaire modification de l'ouvrage
//╚══════════════════════════════════════════╝
//
function formModifyBook()
{
     $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
     $book = $bookManager->getBook($_GET['id']);
    require('view/backend/updateBookView.php');
}
//╔══════════════════════════════════════════╗  
//    vue formulaire nouveau chapitre
//╚══════════════════════════════════════════╝
//
function formNewPost()
{

    require('view/backend/newPostView.php');
}

//╔══════════════════════════════════════════╗  
//    vue formulaire nouvel ouvrage
//╚══════════════════════════════════════════╝
//
function formNewBook()
{

require('view/backend/newBookView.php');
}
//╔══════════════════════════════════════════╗  
//    fonction upload image
//╚══════════════════════════════════════════╝
//

function uploadImage($postId){
   
    $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
    $article = $postManager->getPost($postId);
    $image =$article['ART_IMAGE'];/// récupération
   
    
     if(!empty($_FILES['uploaded_file']['name']))
  {
 $extensions_valides = array('jpg');
//1. strrchr renvoie l'extension avec le point (« . »).
//2. strtolower met l'extension en minuscules.
$extension_upload = strtolower(  strrchr($_FILES['uploaded_file']['name'], '.')  );
$path = "uploads/";
$_FILES['uploaded_file']['name']= 'chapitre-'.$article['ART_CHAPTER'].$extension_upload ;
$path = $path . basename( $_FILES['uploaded_file']['name']);
echo $path  ;
if ( in_array($extension_upload,$extensions_valides) ) {
    if(is_file($path)){
unlink($path);
}
    }elseif(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      $message = "Le fichier ".  basename( $_FILES['uploaded_file']['name']). 
      " à été uploadé";
     $image = $_FILES['uploaded_file']['name'];
    } else{
  $message= "Une erreur s'est produite durant l'opération Veuillez vérifier le format du fichier( jpg , jpeg , gif , 'png). Veuillez réessayer . Si le problème persiste , contactez votre administrateur ";
    }
  }  else {
 echo ' cest par la ';
  }
  return $image;
  }
 
//╔══════════════════════════════════════════╗  
//    Fonction mise à jour (update) du chapitre
//╚══════════════════════════════════════════╝
///Lorsqu'on met à jour un article on le desactive par defaut ////////////////

function majPost()
{
    $artId =$_POST['art_id'];
    $image= uploadImage($artId);
 
 $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();

    $article = $postManager->updatePost($_POST['art_chapter'],$_POST['art_title'],$_POST['art_subtitle'],$_POST['art_content'],1,$_POST['art_id'],$_POST['art_description'],$_POST['art_keywords'],$image);
    $_GET['id'] = $_POST['art_id']; 
   post();
} 
function ajouterPost()   
 {
  
   $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
   $chapitre= $_POST['art_chapter'];
   $dernierId = $postManager->addPost($_POST['art_chapter'],$_POST['art_title'],$_POST['art_subtitle'],$_POST['art_content'],$_POST['art_description'],$_POST['art_keywords']);
   $image= uploadImage($dernierId); 
      echo "Ceci est le dernier img : ".$image;
   echo "Ceci est le dernier id : ".$dernierId; 
 
    $article = $postManager->updatePost($_POST['art_chapter'],$_POST['art_title'],$_POST['art_subtitle'],$_POST['art_content'],1,$dernierId,$_POST['art_description'],$_POST['art_keywords'],$image);
    $_GET['id'] = $dernierId; 
   post();
 }

//╔══════════════════════════════════════════╗  
//    Mise à jour d'un Ouvrage 
//╚══════════════════════════════════════════╝
//
function majBook()
{
    $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
     $book = $bookManager->updateBook($_POST['ouv_titre'],$_POST['ouv_preface'],$_POST['ouv_soustitre'],$_POST['ouv_auteur'],$_POST['ouv_description'],$_POST['ouv_keywords'],0,$_POST['ouv_id']);
    $_GET['id'] = $_POST['ouv_id']; 
   book();

} 

//╔══════════════════════════════════════════╗  
//    Ajouter un Ouvrage 
//╚══════════════════════════════════════════╝
//
 
function ajouterOuvrage()   
 {
   $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
   $book = $bookManager->addBook($_POST['ouv_titre'],$_POST['ouv_preface'],$_POST['ouv_soustitre'],$_POST['ouv_auteur'],$_POST['ouv_description'],$_POST['ouv_keywords']);
   listOuvrages();
 }
 
 //╔══════════════════════════════════════════╗  
//    Supprimer un chapitre
//╚══════════════════════════════════════════╝
//
function supprimePost()
{
   
$postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
$post = $postManager->delPost($_GET['id']);  
listPostsResume();
}
//╔══════════════════════════════════════════╗  
//    Supprimer  un Ouvrage 
//╚══════════════════════════════════════════╝
//
function supprimeOuvrage()
{
   
$bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
$book = $bookManager->delBook($_GET['id']);  
    listOuvrages();
}

//╔══════════════════════════════════════════╗  
//    Désactive un chapitre ( non visible - en cours de rédaction)
//╚══════════════════════════════════════════╝
//

function desactiverPost()
{
   
$postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
$post = $postManager->disablePost($_GET['id']);  
 post();
}
//╔══════════════════════════════════════════╗  
//    Publie un chapitre ( rendre visible )
//╚══════════════════════════════════════════╝
//
function publierPost()
{
   
$postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
$post = $postManager->enablePost($_GET['id']); 
post();
}
//╔══════════════════════════════════════════╗  
//    desactive un ouvrage
//╚══════════════════════════════════════════╝
//
function desactiverBook()
{
 $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
$book = $bookManager->disableBook($_GET['id']); 

book();
} 
//╔══════════════════════════════════════════╗  
//    active un ouvrage
//╚══════════════════════════════════════════╝
//
function activerBook()
{
 $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
$book = $bookManager->enableBook($_GET['id']);  
book();
}       

//╔══════════════════════════════════════════════╗  
//    si identification ok on affiche la page identification sinon page erreur 
//╚══════════════════════════════════════════════╝
//
function identification($bool)
{

$param=$bool;
    if($param === FALSE ){
        require('view/backend/erreurView.php');
    
    }else {
     
       
   require_once ('view/backend/identificationView.php');
  
    }
}

//╔══════════════════════════════════════════╗  
//    Renvoi false si uner inconnu ou pb d'identifiant 
//╚══════════════════════════════════════════╝
//
function verifUser()
{
    $userValid=FALSE;
    $userManager = new OpenClassrooms\DWJP4\Backend\Model\usersManager();
    $connect=$userManager->connexion(($_POST['usrname']),($_POST['passwd']));
   
      if($connect > 0){
        $_SESSION['user']='admin';
      $userValid= TRUE;
    } else {
            $userValid= FALSE;
          
      }
    return $userValid;
    }   
//╔══════════════════════════════════════════╗  
//    active un commentaire 
//╚══════════════════════════════════════════╝
//
function activeComment()
{
 $commentManager = new OpenClassrooms\DWJP4\Backend\Model\commentManager();
$comment = $commentManager->enableComment($_GET['commId']);  
 post();
    
}
//╔══════════════════════════════════════════╗  
//    déactive un commentaire 
//╚══════════════════════════════════════════╝
//
function desactiveComment()
{
  
$commentManager = new OpenClassrooms\DWJP4\Backend\Model\commentManager();
$comment = $commentManager->disableComment($_GET['commId']);  
 post();
}   
//╔══════════════════════════════════════════╗  
//    signal  un commentaire 
//╚══════════════════════════════════════════╝
//   
function activeSignal()
{
 $commentManager = new OpenClassrooms\DWJP4\Backend\Model\commentManager();
$comment = $commentManager->enableSignal($_GET['commId']);  
 post();
    
}
//╔══════════════════════════════════════════╗  
//    Supprime le signalement d'un commentaire 
//╚══════════════════════════════════════════╝
// 

function desactiveSignal()
{
  
$commentManager = new OpenClassrooms\DWJP4\Backend\Model\commentManager();
$comment = $commentManager->disableSignal($_GET['commId']);  
 post();
}   

