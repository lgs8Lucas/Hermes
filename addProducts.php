<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <!-- CSS Meu CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <title>Hermes</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-c1">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="assets/img/mercurio.png" alt="Hermes Logo" height="24px">
        Hermes
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.html">Início</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="requests.php">Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="search.php">Produtos</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
  <?php
  include "conection.php";
  @$type = $_POST['type'];
  $id = $_POST['id'];
  $query = mysqli_query($conection, "SELECT * FROM `pedidos` WHERE id = $id", $result_mode = MYSQLI_STORE_RESULT);
  ?>
  <main class="container">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="requests.php">Em aberto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="create_request.html">Criar novo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page">Adicionar Produtos</a>
      </li>
    </ul>
    <br>
    <?php while ($e = mysqli_fetch_array($query)) { ?>
    <div class="rounded-top bg-c1 p-3 text-light">
        <div class="row">
            <div class="col-6">
                <h4><?php echo $e['id']." - ".$e['nome']; ?></h4>
            </div>
            <div class="col-6 text-end">
                <h4><?php echo "Total: R$ ".$e['valor_total']; ?></h4>
            </div>
        </div>
    </div>
    <?php } ?>

    <br>
    <div class="rounded-bottom bg-c1 p-3 text-light">
        <div class="text-end">
            <a data-bs-toggle="modal" data-bs-target="#modalProducts" class="btn btn-link link-success">+ Add Produtos</a>
        </div>
    </div>
  </main>





  <!-- Modal -->
  <div class="modal fade" id="modalProducts" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ModalLabel">Produtos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
        <?php
        $query = mysqli_query($conection, "SELECT * FROM `produtos` WHERE 1", $result_mode = MYSQLI_STORE_RESULT);
        ?>
        <?php while ($e = mysqli_fetch_array($query)) { ?>
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-10">
                <h5 class="card-title"><?php echo $e['id'] . " - " . $e['nome'] ?></h5>
              </div>
              <div class="col-2 text-center">
                QTD
              </div>
            </div>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo "R$ " . $e['valor'] ?></h6>
            <div class="row">
              <div class="col-10">
                <p class="card-text"><?php echo $e['descricao'] ?></p>
              </div>
              <div class="col-2 text-end">
                <input type="number" name="qtdItem" value = 0 required class="form-control">
              </div>
            </div>
            
          </div>
        </div>
        <br>
        <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
      </form>
    </div>
  </div>
</div>



  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>