

<?php $title = 'Jean FORTEROCHE'; ?>



<?php ob_start(); ?>
<div class="col-sm-4">
         <img src='public/images/couverture2.jpg' title='couverture ouvrage' />
    
   
    
    
</div>

    <div class="col-sm-4">
    <h3>PREFACE</h3>
        "On the other hand, we denounce with righteous indignation and dislike 
        men who are so beguiled and demoralized by the charms of pleasure of the
        moment, so blinded by desire, that they cannot foresee the pain and 
        trouble that are bound to ensue; and equal blame belongs to those who 
        fail in their duty through weakness of will, which is the same as 
        saying through shrinking from toil and pain. These cases are perfectly
        simple and easy to distinguish. In a free hour, when our power of 
        choice is untrammelled and when nothing prevents our being able to do 
   
    
</div>
  <div class="col-sm-4">
  
   <ul>
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
</ul>
    
    
    
</div>

<?php $content = ob_get_clean(); 

?>





<?php require('view/frontend/template.php'); ?>

