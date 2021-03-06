<?php $title = 'Jean FORTEROCHE'; ?>

<?php ob_start(); ?>
<div class='resume'>
    <a href="indexadmin.php?action=newBook" title="Ajouter un ouvrage"><i class="fa fa-plus-square  fa-4x "></i>   Ajouter un ouvrage..</a>
</div>
<?php
while ($data = $books->fetch()) {
    ?>

    <div class='resume'>

        <h2>
            <p>Titre:  <?= htmlspecialchars($data['OUV_TITRE']) ?></p> </h2>

        <h3> <?= htmlspecialchars($data['OUV_SOUSTITRE']) ?> </h3>de <strong><?= htmlspecialchars($data['OUV_AUTEUR']) ?> </strong>          



        <p><em>Description :  <?= htmlspecialchars($data['OUV_DESCRIPTION']) ?></em></p>
        <div class='contenu'>
            <?php
            $contenu = htmlspecialchars($data['OUV_PREFACE']);
            /* $resume=substr($contenu,1,350); */
            ?>
            <?= $contenu ?>
            <br />
            <br />
        </div>
        <div class='icone-admin'>
            <a href="indexadmin.php?action=updateBook&amp;id=<?= $data['OUV_ID'] ?>" title="Modifiez l'ouvrage"><i class="fa  fa-edit  fa-2x "></i></a>
            <?php
            $enable = htmlspecialchars($data['OUV_ENABLE']);
            if (!$enable) {
                echo '<i title="Données Ouvrage inactives" class="fa fa-eye-slash  fa-2x "></i>';
            } else {
                echo '<i title="Données Ouvrage actives" class="fa fa-eye  fa-2x "></i>';
            }
            ?>



            <a href="#" data-toggle="modal" data-target="#deleteModal<?= htmlspecialchars($data['OUV_ID']) ?>" title="Supprimez l'ouvrage"><i class="fa fa-remove  fa-2x"></i></a>
        </div> 
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal<?= htmlspecialchars($data['OUV_ID']) ?>" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4><span class="fa fa-trash"></span> Etes-vous sur de vouloir supprimer l'ouvrage ?<br/>(Vérifiez qu'un ouvrage est actif)</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="indexadmin.php" method="get">
                        <input type="hidden" class="form-control" id="action" name="action"value="delOuvrage">
                        <input type="hidden" class="form-control" id="id" name="id"value="<?= htmlspecialchars($data['OUV_ID']) ?>">   
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
$books->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>




