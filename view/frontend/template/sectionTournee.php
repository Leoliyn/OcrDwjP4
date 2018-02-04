

<div id="tour" class="bg-1">
  <div class="container text-center">
    <a class="up-arrow" href="#myCarousel" data-toggle="tooltip" title="HAUT">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>  
    <h3 class="text-center">RENDEZ-VOUS DEDICACE</h3>
    <p class="text-center">futura coniunx hastam.<br> Réservez pour un meilleur accueil</p>
    <ul class="list-group">
      <li class="list-group-item">Novembre <span class="label label-danger">Terminé. 1280 fans étaient là!</span></li>
      <li class="list-group-item">Décembre <span class="label label-danger">Terminé 1157 fans étaient là!</span></li> 
      <li class="list-group-item">Janvier<span class="badge">3613 participations</span></li> 
    </ul>
    
    <div class="row text-center">
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="public/images/paris.jpg" alt="Paris" width="400" height="300">
          <p><strong>Paris</strong></p>
          <p>Samedi 9 décembre 2017</p>
          <button class="btn" data-toggle="modal" data-target="#myModal">J'y vais</button>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="public/images/toulouse.jpg" alt="Toulouse" width="400" height="300">
          <p><strong>Toulouse</strong></p>
          <p>Venredi 29 janvier 2018</p>
          <button class="btn" data-toggle="modal" data-target="#myModal">J'y vais</button>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="public/images/marseille.jpg" alt="Marseille" width="400" height="300">
          <p><strong>Marseille</strong></p>
          <p>Mercredi 31 mars 2018</p>
          <button class="btn" data-toggle="modal" data-target="#myModal">J'y vais</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Je Participe</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="index.php#tour" methode=POST>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-shopping-cart"></span> Nb Participant(s)</label>
              <input type="number" class="form-control" id="psw" placeholder="Saisir un nombre">
            </div>
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Mon courriel</label>
              <input type="text" class="form-control" id="usrname" placeholder="xxxxxx@xxxx.fr">
            </div>
              <button type="submit" class="btn btn-block">Reservation 
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
</div>