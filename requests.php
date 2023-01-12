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
  switch ($type) {
    case 1:
      $name = $_POST["name"];
      $table = $_POST["table"];
      $date = $_POST["date"];
      $insert = "INSERT INTO `pedidos`(`nome`, `mesa`, `data`) VALUES ('$name','$table','$date')";
      try {
        mysqli_query($conection, $insert) or die("erro");
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              Pedido criado com sucesso!!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      } catch (\Throwable $th) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              Criar pedido, tente novamente!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      }
      break;
  }
  $query = mysqli_query($conection, "SELECT * FROM `pedidos` WHERE `status` = 1", $result_mode = MYSQLI_STORE_RESULT);
  ?>
  <main class="container">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="requests.php">Em aberto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="create_request.html">Criar novo</a>
      </li>
    </ul>
    <br>
    <?php while ($e = mysqli_fetch_array($query)) { ?>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title"><?php echo $e['id'] . " - " . $e['nome'] ?></h5>
          </div>
          <div class="col-6 text-end">
            <?php
      if ($e['status'] == 1) {
        echo "<b class='text-danger'> Faltando produtos</b>";
      }
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <h6 class="card-subtitle text-muted"><?php echo $e['data'] ?></h6>
          </div>
          <div class="col-6 text-end">
            <form action="addProducts.php" method="post">
              <input type="hidden" name="id" value="<?php echo $e['id'] ?>">
              <button type="submit" class="btn card-subtitle btn-link text-success"><i
                  class="bi bi-plus-circle-fill"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </main>



  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>