<?php
require_once('model/backend/PostManager.php');
require_once('model/backend/CommentManager.php');
require_once('model/backend/UsersManager.php');
require_once('model/backend/BookManager.php');

function changePsswd()
{
    
  updatePsswd($userPsswd)  
   require('view/backend/listPostsView.php');  
    
}

function listOuvrages()
{
    $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
    $books = $bookManager->getBooks();

    require('view/backend/listBooksView.php');
}

function listPosts()
{
    $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
    $posts = $postManager->getPostsResume();

    require('view/backend/listPostsView.php');
}


function listPostsResume()
{
    $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
    $posts = $postManager->getPostsResume();

    require('view/backend/listPostsView.php');
}
function book()
{
    $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
    $book = $bookManager->getBook($_GET['id']);
     require('view/backend/bookView.php');
      
}
function post()
{
    $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
    $commentManager = new OpenClassrooms\DWJP4\Backend\Model\CommentManager();

    $article = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
   
    require('view/backend/postView.php');
}
////////////////////////////
function formModifyPost()
{
     $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
     $article = $postManager->getPost($_GET['id']);
    require('view/backend/updatePostView.php');
}
function formModifyBook()
{
     $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
     $book = $bookManager->getBook($_GET['id']);
    require('view/backend/updateBookView.php');
}

function formNewPost()
{

    require('view/backend/newPostView.php');
}
function formNewBook()
{

require('view/backend/newBookView.php');
}
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
 
  }
  return $image;
  }
 

////////////Lorsqu'on met à jour un article on le desactive par defaut ////////////////

function majPost()
{
    
    $image= uploadImage($_POST['art_id']);
 
 $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
    /* $article = $postManager->updatePost($_POST['art_chapter'],$_POST['art_title'],$_POST['art_subtitle'],$_POST['art_content'],$_POST['art_desactive'],$_POST['art_id']);
    $_GET['id'] = $_POST['art_id']; */
    $article = $postManager->updatePost($_POST['art_chapter'],$_POST['art_title'],$_POST['art_subtitle'],$_POST['art_content'],1,$_POST['art_id'],$_POST['art_description'],$_POST['art_keywords'],$image);
    $_GET['id'] = $_POST['art_id']; 
   post();
} 
function majBook()
{
 $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
    /* $article = $postManager->updatePost($_POST['art_chapter'],$_POST['art_title'],$_POST['art_subtitle'],$_POST['art_content'],$_POST['art_desactive'],$_POST['art_id']);
    $_GET['id'] = $_POST['art_id']; */
    $book = $bookManager->updateBook($_POST['ouv_titre'],$_POST['ouv_preface'],$_POST['ouv_soustitre'],$_POST['ouv_auteur'],$_POST['ouv_description'],$_POST['ouv_keywords'],0,$_POST['ouv_id']);
    $_GET['id'] = $_POST['ouv_id']; 
   book();

} 
 function ajouterPost()   
 {
   
   $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
     $article = $postManager->addPost($_POST['art_chapter'],$_POST['art_title'],$_POST['art_subtitle'],$_POST['art_content'],$_POST['art_description'],$_POST['art_keywords']);
    
 listPosts();
 }
function ajouterOuvrage()   
 {
   $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
   $book = $bookManager->addBook($_POST['ouv_titre'],$_POST['ouv_preface'],$_POST['ouv_soustitre'],$_POST['ouv_auteur'],$_POST['ouv_description'],$_POST['ouv_keywords']);
   listOuvrages();
 }
function supprimePost()
{
   
$postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
$post = $postManager->delPost($_GET['id']);  
listPostsResume();
}

function supprimeOuvrage()
{
   
$bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
$book = $bookManager->delBook($_GET['id']);  
    listOuvrages();
}



function desactiverPost()
{
   
$postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
$post = $postManager->disablePost($_GET['id']);  
 post();
}
function publierPost()
{
   
$postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
$post = $postManager->enablePost($_GET['id']); 
post();
}
function desactiverBook()
{
 $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
$book = $bookManager->disableBook($_GET['id']); 

book();
}   
function activerBook()
{
 $bookManager = new OpenClassrooms\DWJP4\Backend\Model\BookManager();
$book = $bookManager->enableBook($_GET['id']);  
book();
}       

function deconnexion()
{
// A RE VOIR
 $_SESSION = array(); session_destroy(); 

	foreach($_SESSION as $cle => $element)
	{
		unset($_SESSION[$cle]);
	}
header('Location: '.ROOTPATH.'/index.php');   
    
    
}
function identification($bool)
{

$param=$bool;
    if($param === FALSE ){
        require('view/backend/erreurView.php');
    
    }else {
     
       
   require_once ('view/backend/identificationView.php');
  
    }
}

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

function activeComment()
{
 $commentManager = new OpenClassrooms\DWJP4\Backend\Model\commentManager();
$comment = $commentManager->enableComment($_GET['commId']);  
 post();
    
    
}
function desactiveComment()
{
  
$commentManager = new OpenClassrooms\DWJP4\Backend\Model\commentManager();
$comment = $commentManager->disableComment($_GET['commId']);  
 post();
}   
    
function activeSignal()
{
 $commentManager = new OpenClassrooms\DWJP4\Backend\Model\commentManager();
$comment = $commentManager->enableSignal($_GET['commId']);  
 post();
    
    
}
function desactiveSignal()
{
  
$commentManager = new OpenClassrooms\DWJP4\Backend\Model\commentManager();
$comment = $commentManager->disableSignal($_GET['commId']);  
 post();
}   

