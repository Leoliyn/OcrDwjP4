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
       <!-- <p><label> Publier en ligne</label></p><p><input type="checkbox" id="art_desactive" name="art_desactive" checked></p>-->
        <label> Chapitre</label><input type="texte" class="form-control" id="art_chapter" name = "art_chapter" value="<?= $data['ART_CHAPTER'] ?>">
        <label> Titre</label><input type="texte" class="form-control" id="art_title" name = "art_title" value="<?= $data['ART_TITLE'] ?>">
        <label> Sous-titre</label><input type="texte" class="form-control" id="art_subtitle" name = "art_subtitle" value="<?= $data['ART_SUBTITLE'] ?>">
        <label> Article</label><textarea style="width: 100%;" name="art_content"><?= $data['ART_CONTENT']?> </textarea>
        <label> Description</label><input style="width: 100%;" name="art_description" id="art_description" value="<?= $data['ART_DESCRIPTION'] ?>" /><br />
        <label> Mots clés (séparés par une virgule)</label><input style="width: 100%;" name="art_keywords" id="art_keywords"  value="<?= $data['ART_KEYWORDS'] ?>"/><br />   
        <input class="btn btn-primary" type="submit" name="send" value="Envoyer" />
        <input class="btn btn-primary" type="reset" name="reset" value="Reset" />
        <a href="indexadmin.php?action=post&amp;id=<?= $data['ART_ID'] ?>"><input class="btn btn-primary" type="button" name="retour" value="Retour" /></a>
        </form>
   <form enctype="multipart/form-data" action="indexadmin.php?action=updatePost&amp;id=<?= $data['ART_ID'] ?>" method="POST">

    <p>Télécharger votre fichier</p>

    <input type="file" name="uploaded_file" />    <input type="submit" value="Upload" />
 <input type="hidden" name="postId" value="<?= $data['ART_ID'] ?>" />
  </form>
<img src='./uploads/<?= $data['ART_IMAGE'] ?>' class="miniature" />
</div>
<?PHP

  if(!empty($_FILES['uploaded_file']))

  {
$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
//1. strrchr renvoie l'extension avec le point (« . »).
 //2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.
$extension_upload = strtolower(  substr(  strrchr($_FILES['uploaded_file']['name'], '.')  ,1)  );
$path = "uploads/";
 
$_FILES['uploaded_file']['name']= 'chapitre-'.$data['ART_CHAPTER'].$extension_upload ;
$path = $path . basename( $_FILES['uploaded_file']['name']);


if ( in_array($extension_upload,$extensions_valides) ) {
    }elseif(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo "Le fichier ".  basename( $_FILES['uploaded_file']['name']). 
      " à été uploadé";
    } else{

        echo "Une erreur s'est produite durant l\'opération Veuillez vérifier le format du fiichier( jpg , jpeg , gif , 'png). Veuillez réessayer . Si le problème persiste , contactez votre administrateur ";

    }

  }

?>
<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>
