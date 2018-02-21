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
$iteration=0;
 $listeCarousel ='<div id="myCarousel" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators">';
 $carousel ='<div class="carousel-inner" role="listbox">';

while ($data = $posts->fetch())
{

setlocale(LC_CTYPE, 'fr_FR.UTF-8');
$titre= iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data['ART_TITLE']);
$titre = strtr($titre, " '@ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ","--aAAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy");
?>
  <li><a href="<?=$data['ART_ID']?>.chapitre<?=$data['ART_CHAPTER']?>.<?= $titre ?>.html">chapitre<?=$data['ART_CHAPTER']?>-<?= $data['ART_TITLE'] ?> </a>
</li>
<!--    <li><a href="chapitre<?=$data['ART_CHAPTER']?>.<?= $titre ?>.<?=$data['ART_ID']?>.html">chapitre<?=$data['ART_CHAPTER']?>-<?= $data['ART_TITLE'] ?> </a>
</li>-->
<?php   

//$contentMenu .= "<li><a href='post";
//$contentMenu .= $data['ART_ID'];
//$contentMenu .= "-chapitre";
//$contentMenu .= $data['ART_CHAPTER'];
// 
//$contentMenu .="'>Chap";
//$contentMenu .=$data['ART_CHAPTER'];
//$contentMenu .=":";
//$contentMenu .=$data['ART_TITLE'];
//$contentMenu .="</a></li>";

$contentMenu .= "<li><a href='chapitre";
$contentMenu .= $data['ART_CHAPTER'];
$contentMenu .= ".";
$contentMenu .= $titre;
$contentMenu .= "."; 
$contentMenu .=$data['ART_ID'];
$contentMenu .=".html'>";
$contentMenu .=$data['ART_CHAPTER'];
$contentMenu .=":";
$contentMenu .=$data['ART_TITLE'];
$contentMenu .="</a></li>";
////////////////////////////////////creation liste ol slider///////////////////////
  $listeCarousel .= '<li data-target="#myCarousel" data-slide-to="';
   $listeCarousel .= $iteration;
 $listeCarousel .= '" class="';
  if($iteration==0){
    $listeCarousel .= 'active">';
   }else {
   $listeCarousel .= '">';
   
    }
   $listeCarousel .= '</li>';   

////////////////////carousel/////////////////////
   $carousel .= '<div class="item '; 
   ////
   if($iteration==0){
    $carousel .= 'active">';
    }else {
   $carousel .= '">';
   
    }
   
  $carousel .='<img src="uploads/'.$data['ART_IMAGE'].'" alt="illustration chapitre" width="1200" height="700">';
  $carousel .='<div class="carousel-caption">';
  $carousel .='<a href="chapitre'.$data['ART_CHAPTER'].'.'.$titre.'.'.$data['ART_ID'].'.html"><h3>'.$data['ART_TITLE']." Chapitre ".$data['ART_CHAPTER'].'</h3>';
  $carousel .='<p>'.$data['ART_SUBTITLE'].'</p></a>';
  $carousel .='</div></div>';
  
  
///////////////////
   $iteration = $iteration +1; 
}
 $listeCarousel .= '</ol>'; 
 $carousel .='</div>';
$posts->closeCursor();
?>
</ul>
    
    
    
</div>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>

  
    <?php
    //  $listeCarousel ='<ol class="carousel-indicators">';
   // $carousel ='<div class="carousel-inner" role="listbox">';
   // $iteration=0;
 //   $carousel ='<div id="myCarousel" class="carousel slide" data-ride="carousel">';
   // while ($data = $posts->fetch())
// 
     
//   $listeCarousel .= '<li data-target="#myCarousel" data-slide-to="';
//   $listeCarousel .= $iteration;
//   $listeCarousel .= 'class="';
//  if($iteration==0){
//    $listeCarousel .= 'active';
//    }else {
//   $listeCarousel .= '';
//   
//    }
//   $listeCarousel .= '"></li>';   
  //$iteration = $iteration +1;
  // $carousel .= '<div class="carousel-inner" role="listbox">
    //  <div class="item '; 
   //////
  // if($iteration==0){
  //  $carousel .= 'active';
 //   }else {
//   $carousel .= '';}
    /////
//   $carousel .= '">';
//  $carousel .='<img src="uploads/';
//  $carousel .=$data['ART_IMAGE'];
//  $carousel .= '" alt="';
//  $carousel .=$data['ART_DESCRIPTION'];
//  $carousel.= '" width="1200" height="700">';
//  $carousel .='<div class="carousel-caption">';
//  $carousel .='<h3>'.$data['ART_TITLE'].$data['ART_CHAPTER'].'</h3>';
//  $carousel .='<p>'.$data['ART_SUBTITLE'].'</p>';
//  $carousel .='  </div>  </div>';

   
   
   
  // }
   // $listeCarousel .= '</ol>'.$iteration; 
    //$carousel .='</div>';
      
 ?>   

<?= $listeCarousel ?>
<?= $carousel ?>

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

