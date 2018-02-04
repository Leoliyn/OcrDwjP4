<?php $title = 'Jean FORTEROCHE'; ?>


<?php ob_start(); ?>


<?php

$data=$article;
?>
<div class='resume'>

    <h3>
        Modification Article

    </h3>

   

    <form action='indexadmin.php?action=majPost' method="post">
           <p><label></label></p><p><input type="hidden" id="date" name="art_date" value="<?= $data['DATE_fr'] ?>"  ></p>
        <p><label></label></p><p><input type="hidden" id="art_id" name="art_id" value="<?= $data['ART_ID'] ?>"  ></p>
        <p><label> Publier en ligne</label></p><p><input type="checkbox" id="art_desactive" name="art_desactive" checked></p>
        <label> Chapitre</label><input type="texte" class="form-control" id="art_chapter" name = "art_chapter" value="<?= $data['ART_CHAPTER'] ?>">
        <label> Titre</label><input type="texte" class="form-control" id="art_title" name = "art_title" value="<?= $data['ART_TITLE'] ?>">
        <label> Sous-titre</label><input type="texte" class="form-control" id="art_subtitle" name = "art_subtitle" value="<?= $data['ART_SUBTITLE'] ?>">
        <label> Article</label><textarea style="width: 100%;" name="art_content"><?= $data['ART_CONTENT']?> </textarea>
        
        <input class="btn btn-primary" type="submit" name="send" value="Envoyer" />

        </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>
