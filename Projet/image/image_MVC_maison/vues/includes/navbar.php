<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Mon gestionnaire d'images</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Accueil</a></li> <!-- class="active" à ajouter en js -->
        <li><a href="index.php?controller=Home&action=aPropos">A propos</a></li>


          <li class="dropdown">
            <a class="active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu Photo <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?controller=Photo&action=first&size=$size">Première image</a></li>
              <li><a href="index.php?controller=Photo&action=random&size=$size&id=$id">Image aléatoire</a></li>
              <li><a href="index.php?controller=PhotoMatrix&action=display&id=$id&size=$size&nbImg=2">Matrice</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="index.php?controller=Photo&action=addImage">Image Supplémentaire</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="index.php?controller=Photo&action=zoom&size=$size&id=$id&zoom=1.25">Zoom +</a></li>
              <li><a href="index.php?controller=Photo&action=zoom&size=$size&id=$id&zoom=0.8">Zoom -</a></li>
            </ul>
          </li>
        <?php
        } 
        else
        { ?>
          <li><a href="index.php?page=photo&action=afficherImage&idImage=1">Photo</a></li>
          <?php
        } ?>


      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>