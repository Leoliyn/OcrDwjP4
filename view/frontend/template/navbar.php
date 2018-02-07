<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
            <a class="navbar-brand" href="#">
                Jean FORTEROCHE
                <?php echo '<i style ="font-size:12px">Billet pour l\'ALASKA</i>';?>
                
            </a>
            
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <?php
        
              echo '<li><a href="index.php">ACCUEIL</a></li>';
              echo '<li><a href="#band">PERSONNAGES</a></li>';
              echo '<li><a href="#tour">RENDEZ-VOUS</a></li>';
              echo '<li><a href="#contact">CONTACT</a></li>';
                ?>
            <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Acces Direct
          <span class="caret"></span></a>
                        <ul class="dropdown-menu">
        
            <?= $contentMenu ?>
                </ul></li>
        </div>
    </div>
</nav>
