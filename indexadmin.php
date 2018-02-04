<?php
session_start();

require_once('controler/backend/backend.php'); 


try {
    if (isset($_SESSION['user'])AND ($_SESSION['user']=='admin')) 
    {
        if(isset($_GET['action'])AND ($_GET['action']=='enablePost')AND (isset($_GET['id'])))
        {
            
        publierPost();
                
        }
        elseif(isset($_GET['action'])AND ($_GET['action']=='disablePost')AND (isset($_GET['id'])))
        {
        desactiverPost();
            
        }
        elseif(isset($_GET['action'])AND ($_GET['action']=='delPost')AND (isset($_GET['id'])))
        {
         supprimePost();
            
        }
        elseif(isset($_GET['action'])AND ($_GET['action']=='post')AND (isset($_GET['id'])))
        {
         post();
          
        }
        elseif(isset($_GET['action'])AND ($_GET['action']=='disableComment')AND (isset($_GET['id'])))
        {
            desactiveComment();
         }
        elseif(isset($_GET['action'])AND ($_GET['action']=='enableComment')AND (isset($_GET['id'])))
        {
            activeComment();
        }
        elseif(isset($_GET['action'])AND ($_GET['action']=='enableSignal')AND (isset($_GET['id'])))
        {
            activeSignal();
         }
        elseif(isset($_GET['action'])AND ($_GET['action']=='disableSignal')AND (isset($_GET['id'])))
        {
            desactiveSignal();     
        }
        elseif(isset($_GET['action'])AND ($_GET['action']=='updatePost')AND (isset($_GET['id'])))
        {
          formModifyPost();
        }
        elseif(isset($_GET['action'])AND ($_GET['action']=='majPost'))
        {
          majPost();
        }
        
        elseif(isset($_GET['action'])AND ($_GET['action']=='newPost'))
        {
         formNewPost();
        }
        
        
        elseif(isset($_GET['action'])AND ($_GET['action']=='addPost'))
        {
        ajouterPost();
        }else{
       listPosts();
        }
        
    }
    elseif(isset($_POST['usrname'])AND isset($_POST['passwd']))
    {
        
      
       if(verifUser()=== TRUE){
      header('Location: indexadmin.php');exit();
       }else {  
          header('Location: indexadmin.php?action=reconnexion');exit(); 
    
       }
    }
    elseif (isset($_GET['action'])AND($_GET['action'] == 'connexion') )
        {         
           
            identification(TRUE);
        }
    elseif (isset($_GET['action'])AND($_GET['action'] == 'reconnexion') )
        {         
           
            identification(FALSE);
        }
  
  
    
    elseif (isset($_GET['action']) AND ($_GET['action']=='deconnexion'))
    {
        deconnexion();
        
    }
        
    else { 
      
        identification(TRUE);
    }
 
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
