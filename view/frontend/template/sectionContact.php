
  
<div id="contact" class="container text-center">
     <a class="up-arrow" href="#myCarousel" data-toggle="tooltip" title="HAUT">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <h3 class="text-center">Contacter jean FORTEROCHE</h3>
  

  <div class="row">
    <div class="col-md-4">
      <p>Fan? Laisser un message.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>Paris, FR</p>
          <p><span class="glyphicon glyphicon-envelope"></span>Email: editionTruc@mail.com</p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6 form-group">
            <form method='post' action='index.php?action=message'/>
          <input class="form-control" id="nomMessage" name="nomMessage" placeholder="Votre nom" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Adresse mail " type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="message" name="message" placeholder="votre message ici !" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
      
              <input class="btn btn-primary" type="submit" name="send" value="Envoyer" />
        <input class="btn btn-primary" type="reset" name="reset" value="Reset" />
        </form>
        </div>
      </div>
    </div>
  </div>
  
  
</div>