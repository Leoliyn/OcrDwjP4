<?php
require_once('model/backend/PostManager.php');
require_once('model/backend/CommentManager.php');
require_once('model/backend/UsersManager.php');


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

function formNewPost()
{

    require('view/backend/newPostView.php');
}


////////////////////////////

function majPost()
{
 $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
     $article = $postManager->updatePost($_POST['art_chapter'],$_POST['art_title'],$_POST['art_subtitle'],$_POST['art_content'],$_POST['art_desactive'],$_POST['art_id']);
    $_GET['id'] = $_POST['art_id']; 
   post();
}   
 function ajouterPost()   
 {
   $postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
     $article = $postManager->addPost($_POST['art_chapter'],$_POST['art_title'],$_POST['art_subtitle'],$_POST['art_content']);
    
 listPosts();
 }

function supprimePost()
{
   
$postManager = new OpenClassrooms\DWJP4\Backend\Model\PostManager();
$post = $postManager->delPost($_GET['id']);  
listPostsResume();
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
