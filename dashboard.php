<?php
session_start();
if(empty($_SESSION)){
  print "<script>location.href='index.php';</script>";
}

?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/espaço marques.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Espaço Marques</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="img/espaço marques_70x70.jpg" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=novo">Novo Aluno</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=listar">Listar Alunos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=postar">Postar</a>
        </li>
        <li class="nav-item">
          <?php
            print "Olá, " . $_SESSION["usuario"];
            print " <a href='logout.php' class='btn btn-danger'>Sair</a>";
          ?>
        </li>     
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
        <div class="row">
            <div class="col mt-5">
              
            <?php
             if (isset($_SESSION["mensagem"])) {
              echo '<div class="alert alert-' . $_SESSION["tipo_mensagem"] . '" role="alert">' . $_SESSION["mensagem"] . '  
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
              </div>';
              unset($_SESSION["mensagem"]);
              unset($_SESSION["tipo_mensagem"]);
            }
              include("config.php");
              switch (@$_REQUEST["page"]) {
                case "novo":
                include("novo-aluno.php");
                break;
                case "listar":
                include("listar-aluno.php");
                break;
                case "salvar":
                include("salvar-aluno.php");
                break;
                case "editar":
                include("editar-aluno.php");
                break;
                case "postar":
                include("postagens.php");
                break;           
                default:
                echo '<h1>Bem-vindos!</h1>
                  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                  <div class="carousel-inner">
                  <div class="carousel-item active">
                  <img src="img/1.jpg" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="img/2.jpg" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="img/3.jpg" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="img/4.jpg" class="d-block w-100" alt="...">
                  </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                  </button>
                </div>';
              
              include("listar_postagens.php");
        break;
}
?>
        </div>
        </div>
      </div>

    </div>

    <script src="js/funções.js"></script>
    <script src=js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>
