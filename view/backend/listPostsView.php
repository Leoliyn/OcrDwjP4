

<?php $title = 'Jean FORTEROCHE'; ?>

<?php ob_start(); ?>
<div class='resume'>
<a href="indexadmin.php?action=newPost&amp;id=<?= $data['ART_ID'] ?>" title="Ajouter un article"><i class="fa fa-plus-square  fa-4x "></i>   Ajouter un chapitre..</a>
</div>
<?php
while ($data = $posts->fetch())
{
?>

    <div class='resume'>
        
        <h3>
            <p>Chapitre:  <?= $data['ART_CHAPTER'] ?></p>
            <?= $data['ART_TITLE'] ?>
            
        </h3>
       
        <p><em>le <?= $data['DATE_fr'] ?></em></p>
   <div class='contenu'>
            <?php 
    $contenu=$data['ART_CONTENT'];
    /*$resume=substr($contenu,1,350);*/
 ?>
            <?= $contenu ?>
            <br />
            <br />
        </div>
        <div class='icone-admin'>
            <a href="indexadmin.php?action=post&amp;id=<?= $data['ART_ID'] ?>" title="Accédez aux commentaires"><div class ='nbcomm'><?= $data['NBCOMMENT'] ?></div><i class="fa fa-commenting-o fa-2x"></i></a>
            <a href="indexadmin.php?action=updatePost&amp;id=<?= $data['ART_ID'] ?>" title="Modifiez l'article"><i class="fa  fa-edit  fa-2x "></i></a>
    <?php
     $desactive=$data['ART_DESACTIVE'];
     if($desactive){
       echo '<i title="Article en cours de rédaction" class="fa fa-eye-slash  fa-2x "></i>';
     } else {
      echo '<i title="Article en ligne" class="fa fa-eye  fa-2x "></i>';
     }
 ?>
     
  

            <a href="#" data-toggle="modal" data-target="#deleteModal<?= $data['ART_ID'] ?>" title="Supprimez l'article"><i class="fa fa-remove  fa-2x"></i></a>
          </div> 
    </div>
<!-- Modal -->
  <div class="modal fade" id="deleteModal<?= $data['ART_ID'] ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
      
          <h4><span class="fa fa-trash"></span> Etes-vous sur de vouloir supprimer l'article ?</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="indexadmin.php" method="get">
          <input type="hidden" class="form-control" id="action" name="action"value="delPost">
           <input type="hidden" class="form-control" id="id" name="id"value="<?= $data['ART_ID'] ?>">   
              <button type="submit" class="btn btn-block">Supprimer
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Annulation
          </button>
      
        </div>
      </div>
    </div>
  </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>



