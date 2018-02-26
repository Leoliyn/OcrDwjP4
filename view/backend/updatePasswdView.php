<?php $title = 'Jean FORTEROCHE'; ?>


<?php ob_start(); ?>

<?php
if (isset($message)){
    echo $message;
}

?>

<div class='resume'>

    <h3>
        Modification Mot de passe 

    </h3>

    <form action='indexadmin.php?action=changePsswd' method="post">
           
        <p><label></label></p><p><input type="hidden" id="ouv_id" name="ouv_id" value="<?= $data['OUV_ID'] ?>"  ></p>
            <label>Mot de passe actuel</label><input type="password" class="form-control" id="oldmdp" name = "oldmdp">
            <label> Nouveau Mot de passe </label><input type="password" class="form-control" id="mdp" name = "mdp">
        
        <input class="btn btn-primary" type="submit" name="send" value="Envoyer" />
        <input class="btn btn-primary" type="reset" name="reset" value="Reset" />
        <a href="indexadmin.php"><input class="btn btn-primary" type="button" name="retour" value="Retour" /></a>
        </form>
   

  


<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>
