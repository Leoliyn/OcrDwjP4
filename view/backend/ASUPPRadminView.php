

<?php $title = 'Jean FORTEROCHE'; ?>

<?php ob_start(); ?>


<?php
while ($data = $posts->fetch())
{
?>
    <div class='resume'>
        
        <h3>
            <?= htmlspecialchars($data['ART_TITLE']) ?>
            
        </h3>
       
        <p><em>le <?= $data['DATE_fr'] ?></em></p>
   <p>
            
            <?= nl2br(htmlspecialchars($data['ART_CONTENT_RESUME'])).'(...)' ?>
            <br />
            
        </p>
        <div class='icone-admin'>
            <a href="index.php?action=post&amp;id=<?= $data['ART_ID'] ?>" title="Accédez aux commentaires"><i class="fa fa-commenting-o fa-2x"></i></a>
            <a href="index.php?action=post&amp;id=<?= $data['ART_ID'] ?>" title="Modifiez l'article"><i class="fa  fa-edit  fa-2x "></i></a>
            <a href="index.php?action=post&amp;id=<?= $data['ART_ID'] ?>" title="Publiez l'article"><i class="fa fa-eye  fa-2x "></i></a>
            <a href="index.php?action=post&amp;id=<?= $data['ART_ID'] ?>" title="En cours de rédaction"><i class="fa fa-eye-slash  fa-2x "></i></a>
            <a href="index.php?action=post&amp;id=<?= $data['ART_ID'] ?>" title="Supprimez l'article"><i class="fa fa-remove  fa-2x"></i></a>
          </div> 
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('/view/backend/template.php'); ?>




