<?php $title = 'Jean FORTEROCHE'; ?>
<?php ob_start();?>

<?php
while ($data = $posts->fetch())
{

?>  


    <li><a href="index.php?action=post&id=<?= $data['ART_ID']?>">Chap <?= $data['ART_CHAPTER']?> :<?=$data['ART_TITLE']?> </a>
</li>
 

<?php
}

$posts->closeCursor();
?>

    

<?php $contentMenu = ob_get_clean(); ?>


<?php ob_start(); ?>


<?php

$data=$article;
?>
    <div class='resume'>
        
        <h3>
            <?= htmlspecialchars($data['ART_TITLE']) ?>
            
        </h3>
       
        <p><em>le <?= $data['DATE_fr'] ?></em></p>
   <p><?= ($data['ART_CONTENT']) ?></p>

    </div>
 
<h2>Votre commentaire</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
<div class ='text-center'>
<a class="up-arrow " href="#myCarousel" data-toggle="tooltip" title="HAUT">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
</div>
<h2>Commentaire(s)</h2>
<?php
while ($comment = $comments->fetch())
{
?>
<div class='resume '>
    <?php
   
 $commentSignale=$comment['SIGNALE'];
     if($commentSignale){ 
    echo '<i class="fa fa-thumbs-down  fa-2x red"></i>';
    }else{
          echo '<a href="indexadmin.php?action=enableSignal&amp;commId='.$comment['COMM_ID'].'&amp;id='.$data['ART_ID'].'" title="Cliquez pour signaler le commentaire"><i class="fa fa-thumbs-o-up  fa-2x vert"></i></a>';   
         
     }
 ?>
    <p><strong><?= htmlspecialchars($comment['COMM_PSEUDO']) ?></strong> le <?= $comment['COMM_date_fr'] ?></p>
      <div >  
    <p><?= nl2br(htmlspecialchars($comment['COMM_TITRE'])) ?></p>
<p><?= nl2br(htmlspecialchars($comment['COMM_CONTENU'])) ?></p>

    </div>
    
</div>

<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
