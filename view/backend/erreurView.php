
<?php $title = 'Jean FORTEROCHE'; ?>

<?php ob_start(); ?>

<div class='resume'>
        
        <h6>
            erreur d'identification veuillez vérifier vos identifiants. 
            
        </h6>
</div>
 <button class="btn" data-toggle="modal" data-target="#myModal">Je m'identifie</button>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="fa fa-id-card"></span> Je me connecte</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="indexadmin.php" method="post">
            <div class="form-group">
              <label for="usrname"><span class="fa fa-user fa2x"></span> Identifiant</label>
              <input type="text" class="form-control" id="usrname" name="usrname"placeholder="saisir votre identifiant">
            </div>
            <div class="form-group">
              <label for="passwd"><span class="fa fa-key"></span> Mot de passe</label>
              <input type="password" class="form-control" id="passwd" name="passwd" placeholder="saisir votre mot de passe">
            </div>
              <button type="submit" class="btn btn-block">Envoyez! 
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
<?php $content = ob_get_clean(); ?>
<?php
require('view/backend/template.php');
?>