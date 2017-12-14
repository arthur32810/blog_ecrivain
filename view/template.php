<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Histoire 'Billet Simple pour l'Alaska' écrit par Jean Forteroche">
    <meta name="author" content="Arthur Robert">

    <LINK REL="SHORTCUT ICON" href="public/img/alaska.ico">
        

    <title> <?= $title?> </title>
    <?php if(!empty($script)){ echo $script;} ?>

    <!-- Bootstrap core CSS -->
    <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="public/css/clean-blog.min.css" rel="stylesheet">



  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="index.php">Jean Forteroche</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Histoire</a>
            </li>
            <?php if(!isset($_SESSION['pseudo'])){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=connect">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=inscription">Inscription</a>
                </li>
            <?php }
                elseif (isset($_SESSION['pseudo'])) { ?>
                <?php if($_SESSION['role'] == 'admin'){ ?>
                            <li class="nav-item">
                              <a class="nav-link" href="index.php?action=updateUser">Modification d'un utilisateur</a>
                            </li>   
                <?php } 
                    else { ?>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?action=updateUser">Modification de mon compte</a>
                        </li>
                    <?php } ?>

                <?php if(!empty($_SESSION['role'])){
                        if( $_SESSION['role'] == 'moderator' || $_SESSION['role'] == 'admin'){ ?>
                            <li class="nav-item">
                              <a class="nav-link" href="index.php?action=moderation">Modération</a>
                            </li> 
                       <?php }
                    } 
                if($_SESSION['role'] == 'author'){ ?>
                    <li class="nav-item">
                      <a class="nav-link" href="index.php?action=write_post"> Ecrire un chapitre</a>
                    </li>
               <?php } ?>
                
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=deconnection">deconnexion</a>
                </li> 
            <?php }?>            
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead " style="background-image: url('public/img/alaska-lg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Billet simple pour l'Alaska</h1>
              <span class="subheading">Une histoire pour petit et grand</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <?= $content ?>
            </div>
    </div>  
</div>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <p class="copyright text-muted">Copyright 2017 &copy; Jean Forteroche - Billet simple pour l'Alaska </p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="public/js/clean-blog.min.js"></script>

  </body>

</html>
