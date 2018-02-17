




<?php ob_start(); ?>
<div class="col-sm-4">
         <img src='public/images/couverture2.jpg' title='couverture ouvrage' />
    
<?php
while ($dataBook = $books->fetch())
{
$auteur = $dataBook['OUV_AUTEUR'];
$description =$dataBook['OUV_DESCRIPTION'];
$bookPreface =$dataBook['OUV_PREFACE'];
$bookTitre =$dataBook['OUV_TITRE'];
$bookSoustitre =$dataBook['OUV_SOUSTITRE']; 
$title= $auteur." ".$bookTitre;
}
 ?>   
    
</div>

    <div class="col-sm-4">
    <h3>PREFACE</h3>
    <?= $bookPreface ?>    
   
    
</div>
  <div class="col-sm-4">
  
   <ul>
<?php
$contentMenu="";
while ($data = $posts->fetch())
{

?>  


  
    <li><a href="post<?= $data['ART_ID']?>-chapitre<?=$data['ART_CHAPTER']?>">Chap <?= $data['ART_CHAPTER']?> :<?=$data['ART_TITLE']?> </a>
</li>
<?php   

$contentMenu .= "<li><a href='post";
$contentMenu .= $data['ART_ID'];
$contentMenu .= "-chapitre";
$contentMenu .= $data['ART_CHAPTER'];
 
$contentMenu .="'>Chap";
$contentMenu .=$data['ART_CHAPTER'];
$contentMenu .=":";
$contentMenu .=$data['ART_TITLE'];
$contentMenu .="</a></li>";
}
$posts->closeCursor();
?>
</ul>
    
    
    
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
     
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="public/images/1.jpg" alt="New York" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Jo CASH</h3>
          <p>militibus omne latus Isauriae defendentibus adsueti.</p>
        </div>      
      </div>

      <div class="item">
        <img src="public/images/2.jpg" alt="Chicago" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Juneau</h3>
          <p>posse dicere et in illis quidem parandis adhibere curam.</p>
        </div>      
      </div>
    
      <div class="item">
        <img src="public/images/3.jpg" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Anchorage</h3>
          <p>cuius generis est magna penuria.</p>
        </div>      
      </div>
         <div class="item">
        <img src="public/images/4.jpg" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Houston</h3>
          <p>illis semper in fuga uxoresque mercenariae Venice.</p>
        </div>      
      </div>
         <div class="item">
        <img src="public/images/4.jpg" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Retour ?</h3>
          <p>futura coniunx hastam.</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<?php $slider = ob_get_clean();?>


<?php require('view/frontend/template.php'); ?>

