<?php $title = 'Jean FORTEROCHE'; ?>


<?php ob_start(); ?>


<div class='resume'>

    <h3>
        Nouvel Ouvrage </h3><h4>(Désactivera les autres enregistrements au profit de celui ci )</h4>



    <form action='indexadmin.php?action=addBook' method="post">


        <p><!--<label> Publier en ligne</label></p><p><input type="checkbox" id="art_desactive" name="art_desactive" value=1 ></p>-->
            <label> Auteur</label><input type="texte" class="form-control" id="ouv_auteur" name = "ouv_auteur" value="">
            <label> Titre</label><input type="texte" class="form-control" id="ouv_titre" name = "ouv_titre" value="">
            <label> Sous-Titre</label><input type="texte" class="form-control" id="ouv_soustitre" name = "ouv_soustitre" value="">
            <label> Préface</label><textarea style="width: 100%;" name="ouv_preface"><br /></textarea>
            <label> Description</label><input style="width: 100%;" name="ouv_description" id="ouv_description" /><br />
            <label> Mots clés (séparés par une virgule)</label><input style="width: 100%;" name="ouv_keywords" id="ouv_keywords" value="blog,écrivain,"/><br />   
            <input class="btn btn-primary" type="submit" name="send" value="Envoyer" />
            <input class="btn btn-primary" type="reset" name="reset" value="Reset" />
            <a href="indexadmin.php"><input class="btn btn-primary" type="button" name="retour" value="Retour" /></a>
    </form>

</div>




<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>
