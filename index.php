<?php
session_start();
require_once  'controler/frontend/frontend.php'; 
if(isset($_GET['action'])AND ($_GET['action']=='post')AND (isset($_GET['id'])))
        {
      post();
}else{
      
        listPostsResume();        
        }




