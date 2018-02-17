<?php $title = 'Jean FORTEROCHE'; ?>


<?php ob_start(); ?>


<?php

$data=$book;
echo $data['OUV_ID'];
?>
<div class='resume'>

    <h3>
        Modification Ouvrage

    </h3>

    <form action='indexadmin.php?action=majBook' method="post">
           
        <p><label></label></p><p><input type="hidden" id="ouv_id" name="ouv_id" value="<?= $data['OUV_ID'] ?>"  ></p>
            <label> Auteur</label><input type="texte" class="form-control" id="ouv_auteur" name = "ouv_auteur" value="<?= $data['OUV_AUTEUR'] ?>">
        <label> Titre</label><input type="texte" class="form-control" id="ouv_titre" name = "ouv_titre" value="<?= $data['OUV_TITRE'] ?>">
        <label> Sous-titre</label><input type="texte" class="form-control" id="ouv_soustitre" name = "ouv_soustitre" value="<?= $data['OUV_SOUSTITRE'] ?>">
        <label> Préface</label><textarea style="width: 100%;" name="ouv_preface"><?= $data['OUV_PREFACE']?> </textarea>
        <label> Description</label><input style="width: 100%;" name="ouv_description" id="ouv_description" value="<?= $data['OUV_DESCRIPTION'] ?>" /><br />
        <label> Mots clés (séparés par une virgule)</label><input style="width: 100%;" name="ouv_keywords" id="ouv_keywords"  value="<?= $data['OUV_KEYWORDS'] ?>"/><br />   
        <input class="btn btn-primary" type="submit" name="send" value="Envoyer" />
        <input class="btn btn-primary" type="reset" name="reset" value="Reset" />
        <a href="indexadmin.php?action=book&amp;id=<?= $data['ART_ID'] ?>"><input class="btn btn-primary" type="button" name="retour" value="Retour" /></a>
        </form>
   

  


<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>
