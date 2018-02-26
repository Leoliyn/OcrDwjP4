<?php
//╔═════════════════════════════╗  
//           PROJET 4 DWJ OPENCLASSROOMS         
//           CLAUDEY Lionel Février 2018           
//╚═════════════════════════════╝
//GESTION DES UTILISATEURS  LISTE - AJOUTER- MODIFIER- SUPPRIMER - CHANGER PSSQWD -CONNEXION VERIF 
namespace OpenClassrooms\DWJP4\Backend\Model;

require_once("model/backend/Manager.php");

class UsersManager extends Manager
{
    
    // Méthode création sha1 du password
    public function passwordUser($password)
    {
     $mdp = sha1($password);
    
        return $mdp;
    }
    
    // methode de création d un utilisateur 
    public function createUser($userName,$userLastname,$userPseudo,$userMail,$userPsswd,$userstatut)
    
    {
       $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users (USER_NAME,USER_LASTNAME,USER_PSEUDO,USER_MAIL,USER_PSSWD,USER_STATUT)VALUES
(:userName,:userLastname,:userPseudo,:userMail,:userPsswd,:userstatut');
        $req->execute(array( $userName,$userLastname,$userPseudo,$userMail,$userPsswd,$userstatut));  
        return $req;  
       
    }
    
    public function getUser ($id)
    {
      $db = $this->dbConnect();
        $req = $db->query('SELECT USER_NAME,USER_LASTNAME,USER_PSEUDO,USER_MAIL,USER_PSSWD,USER_STATUT FROM users WHERE USER_ID= ?');
$req->execute(array($id));  
        return $req;  
        
        
        
    }
    
    public function delUser($id)
    {
    $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM users WHERE USER_ID = :id');
        $req->execute(array($id));  
        return $req;      
        
    }
    
        public function updatePsswd($userPsswd)
   
    {
    $psswd = passwordUser($userPsswd);        
    $db = $this->dbConnect();
      $req = $db->prepare('UPDATE users SET  USER_PSSWD=? WHERE USER_NAME= ?');
    $req->execute(array( $psswd,'admin'));  
        
    }
 
    public function updateUser($userName,$userLastname,$userPseudo,$userMail,$userPsswd,$userstatut)
   
    {
    $db = $this->dbConnect();
      $req = $db->prepare('UPDATE users SET  USER_NAME= ?,USER_LASTNAME=?,USER_PSEUDO=?,USER_MAIL=?,USER_PSSWD=?,USER_STATUT=?, WHERE id= ?');
    $req->execute(array( $userName,$userLastname,$userPseudo,$userMail,$userPsswd,$userstatut));  
        
    }
                      
// methode connexion compare les identifiant de connexion avec la base users 
    public function connexion($pseudo,$password)
    {
                $db = $this->dbConnect();
    
        $nbrow =0;
        $pwd = $this->passwordUser($password);//hash du mot de passe
        $req = $db->prepare('SELECT * FROM users WHERE USER_PSEUDO = ? AND USER_PASSWD = ?');
        $req->execute(array($pseudo,$pwd));
        $row = $req->fetchAll();
           
        $nbrow = count($row);
      
        return $nbrow;  // si nb  ligne = 0 alors erreur d'identification   
        
        
    }
    
}
