<?php ob_start(); ?>


<!--    <div class="col-sm-3 col-xs-12">
         <img  class= 'couverture' src='public/images/couverture2.jpg' title='couverture ouvrage' />
-->
<?php
//while ($dataBook = $books->fetch())
//{
//$auteur = htmlspecialchars($dataBook['OUV_AUTEUR']);
//$description =htmlspecialchars($dataBook['OUV_DESCRIPTION']);
//$bookPreface =htmlspecialchars($dataBook['OUV_PREFACE']);
//$bookTitre =htmlspecialchars($dataBook['OUV_TITRE']);
//$bookSoustitre =htmlspecialchars($dataBook['OUV_SOUSTITRE']); 
//$title= $auteur." ".$bookTitre;
//$keywords=htmlspecialchars($dataBook['OUV_KEYWORDS']);
//$image ='public/images/couverture2.jpg';
//}
//$books->closeCursor();
//////EN RAISON DUN PROBLEME DE NB CONNEXION CHEZ ONLINE 
$auteur = "Jean FORTEROCHE";
$description = "grement au Dr. En modifiant lgrement ses documents.David avait d sasseoir lorsquil avait entendu le prnom Florence. ";
$bookPreface = "<p>Un long silence se fit dans la voiture. Le chauffeur regardait droit devant. David jeta un &oelig;il sur le compteur qui affichait 210km/h. L&rsquo;autoroute &eacute;tait d&eacute;serte. Depuis la construction de la Ligne Grande Vitesse, les gens pr&eacute;f&eacute;raient prendre les transports en communs, plus rapides et moins chers. La LGV traversait la France d'un bout &agrave; l'autre avec un arr&ecirc;t &agrave; Paris. C&rsquo;est lui aussi qui &eacute;tait &agrave; la base du dernier processeur, le sph&eacute;ro. Un processeur ayant une architecture en forme de sph&egrave;re et capable de traiter les informations &agrave; une vitesse jamais atteinte. Tous les ordinateurs en &eacute;taient &eacute;quip&eacute;s. Le cr&eacute;ateur officiel, le Dr.</p>";
$bookTitre = "Billet simple pour l'ALASKA";
$bookSoustitre = "Inuits inouïs";
$title = "Blog de " . $auteur . " " . $bookTitre;
$keywords = "écrivain, livre, Alaska, chiens, Jefferson, Galimède,Joe CASH";
$image = 'public/images/couverture2.jpg';
?>   

<!--</div>-->
<div class="  text-center ">
    <h1>  <?= $bookTitre ?>  </h1>

</div>

<div class="  text-center ">
    <h3>PREFACE</h3>

    <?= $bookPreface ?>

</div>
<div class="" >
    <ul>
        <?php
        $contentMenu = "";
        $iteration = 0;
        $listeCarousel = '<div id="myCarousel" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators">';
        $carousel = '<div class="carousel-inner" role="listbox">';

        while ($data = $posts->fetch()) {

            setlocale(LC_CTYPE, 'fr_FR.UTF-8');
            $titre = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data['ART_TITLE']);
            $titre = strtr($titre, "'@ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ", "-aAAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy");
            $titre = strtr($titre, " ", "_");
            ?>

            <li><a href="chapitre-<?= htmlspecialchars($data['ART_CHAPTER']) ?>-<?= $titre ?>-<?= htmlspecialchars($data['ART_ID']) ?>.html">chapitre<?= htmlspecialchars($data['ART_CHAPTER']) ?>-<?= htmlspecialchars($data['ART_TITLE']) ?></a>
            </li>
    <?php
    $contentMenu .= "<li><a href='";

    $contentMenu .= "chapitre-";
    $contentMenu .= htmlspecialchars($data['ART_CHAPTER']);
    $contentMenu .= "-" . $titre . "-";
    $contentMenu .= htmlspecialchars($data['ART_ID']);
    $contentMenu .= ".html'>";
    $contentMenu .= htmlspecialchars($data['ART_CHAPTER']);
    $contentMenu .= ":";
    $contentMenu .= htmlspecialchars($data['ART_TITLE']);
    $contentMenu .= "</a></li>";
////////////////////////////////////creation liste ol slider///////////////////////
    $listeCarousel .= '<li data-target="#myCarousel" data-slide-to="';
    $listeCarousel .= $iteration;
    $listeCarousel .= '" class="';
    if ($iteration == 0) {
        $listeCarousel .= 'active">';
    } else {
        $listeCarousel .= '">';
    }
    $listeCarousel .= '</li>';

////////////////////carousel/////////////////////
    $carousel .= '<div class="item ';
    ////
    if ($iteration == 0) {
        $carousel .= 'active ">';
    } else {
        $carousel .= '">';
    }

    $carousel .= '<img class="imgCarousel" src="uploads/' . htmlspecialchars($data['ART_IMAGE']) . '" alt="illustration chapitre" >';
    $carousel .= '<div class="carousel-caption">';
    $carousel .= '<a class="lienSlider" href="chapitre-' . htmlspecialchars($data['ART_CHAPTER']) . '-' . htmlspecialchars($titre) . '-' . htmlspecialchars($data['ART_ID']) . '.html" ><h3>' . $data['ART_TITLE'] . " Chapitre " . $data['ART_CHAPTER'] . '"';
    $carousel .= '<br />' . htmlspecialchars($data['ART_SUBTITLE']) . '</h3></a>';
    $carousel .= '</div></div>';


///////////////////
    $iteration = $iteration + 1;
}
$listeCarousel .= '</ol>';
$carousel .= '</div>';
$posts->closeCursor();
?>
    </ul>



</div>


<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>



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



<?php $slider = ob_get_clean(); ?>


<?php require('view/frontend/template.php'); ?>

