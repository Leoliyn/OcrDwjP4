<?php $title = 'Jean FORTEROCHE Billet simple pour l\'ALASKA '; ?>
<?php ob_start();?>
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

while ($data = $posts->fetch())
{

setlocale(LC_CTYPE, 'fr_FR.UTF-8');
$titre0= iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data['ART_TITLE']);
$titre = strtr($titre0, " '@ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ","--aAAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy");
?>

<!--  <li><a href="<?=$data['ART_ID']?>.chapitre<?=$data['ART_CHAPTER']?>.<?= $titre ?>.html">chapitre<?=$data['ART_CHAPTER']?>-<?= $data['ART_TITLE'] ?> </a>
</li>-->
<li><a href="chapitre-<?=$data['ART_CHAPTER']?>-<?= $titre ?>-<?=$data['ART_ID']?>.html">chapitre<?=$data['ART_CHAPTER']?>-<?= $data['ART_TITLE'] ?> </a>
</li>
    <?php

}

$posts->closeCursor();
?>



    <?php $contentMenu = ob_get_clean(); ?>


    <?php ob_start(); ?>


    <?php

$data=$article;
$title .= $data['ART_TITLE'];
$description =$data['ART_DESCRIPTION'];
$keywords = $data['ART_KEYWORDS'];
$image = 'uploads/'.$data['ART_IMAGE'];
?>
        <div class=''>

            <h3>
                <?= htmlspecialchars($data['ART_TITLE']) ?>

            </h3>

            <p><em>le <?= $data['DATE_fr'] ?></em></p>
            <p>
                <?= ($data['ART_CONTENT']) ?>
            </p>

        </div>
 <div class='text-center'>
        <h2>Votre commentaire</h2>

        <form action="commentaire<?= $data['ART_ID'] ?>" method="post">
            <div>
                <input type="hidden" id="postId" name="postId" value="<?= $data['ART_ID'] ?>" />
                <label for="author">Auteur</label><br />
                <input type="text" id="author" name="author" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input class="btn btn-primary" type="submit" name="envoyerComm" value="Envoyer" />
            </div>
        </form>
        <div class='text-center'>
            <a class="up-arrow " href="#myCarousel" data-toggle="tooltip" title="HAUT">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
        </div>
 </div> 
        <?php
while ($comment = $comments->fetch())
   
{
?>
            <div class=''>
                <?php
   
 $commentSignale=$comment['SIGNALE'];
     if($commentSignale){ 
    echo '<i class="fa fa-thumbs-down  fa-2x red"></i>';
    }else{
          echo '<a href="signalement'.$comment['COMM_ID']."-".$data['ART_ID'].'" title="Cliquez pour signaler le commentaire"><i class="fa fa-thumbs-o-up  fa-2x vert"></i></a>';   
         
     }
 ?>
                    <p><strong><?= htmlspecialchars($comment['COMM_PSEUDO']) ?> </strong>a écrit le
                        <?= $comment['COMM_date_fr'] ?>
                    </p>
                    <div>
                        <p>
                            <?= nl2br(htmlspecialchars($comment['COMM_TITRE'])) ?>
                        </p>
                        <p>
                            <?= nl2br(htmlspecialchars($comment['COMM_CONTENU'])) ?>
                        </p>

                    </div>

            </div>

            <?php
}
?>
            <?php $content = ob_get_clean(); ?>
            <?php ob_start(); ?>

            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
            <?php
        $filename= "uploads/";
        $filename .= $data['ART_IMAGE'];
    
         if (file_exists($filename)) {
                       ?>
                            <img src="uploads/<?= $data['ART_IMAGE'] ?>" alt="illustration <?= $data['ART_TITLE'] ?><?= $data['ART_SUBTITLE'] ?><?= $data['ART_CHAPTER'] ?>" width="1200" height="700">
                            <?php 
         }else{ ?>
                            <img src="public/images/1.jpg" alt="illustration <?= $data['ART_TITLE'] ?>" "<?= $data['ART_SUBTITLE'] ?>" Chapitre "<?= $data['ART_CHAPTER'] ?>" width="1200" height="700">

                            <?php 
         }
          
          ?>
                            <div class="carousel-caption">
                                <h2>Chapitre
                                    <?= $data['ART_CHAPTER'] ?>
                                </h2>
                                <h1>
                                    <?= $data['ART_TITLE'] ?>
                                </h1>
                                <h3>
                                    <?= $data['ART_SUBTITLE'] ?>
                                </h3>

                            </div>
                    </div>
                </div>

            </div>

            <?php $slider = ob_get_clean();?>

            <?php require('template.php'); ?>
