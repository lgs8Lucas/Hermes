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
            <a class="nav-link" aria-current="page" href="requests.php">Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="search.php">Produtos</a>
          </li>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
  <main class="container">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="search.php">Consultar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addProduct.html">Cadastrar</a>
      </li>
    </ul>
    <br>

    <?php
    include("conection.php");
    if ($_POST == null) {
      @$type = $_GET["type"];
    } else {
      @$type = $_POST["type"];
    }
    switch ($type) {
      case 1:
        $name = $_POST["name"];
        $value = $_POST["val"];
        $desc = $_POST["desc"];
        $insert = "INSERT INTO produtos (nome, descricao, valor) VALUES ('$name', '$desc', '$value')";
        try {
          mysqli_query($conection, $insert) or die("erro");
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              Produto Cadastrado com sucesso!!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } catch (\Throwable $th) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              Erro ao cadastrar produto, tente novamente!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        break;
      case 2:
        $id = $_POST["id"];
        $name = $_POST["name"];
        $value = $_POST["val"];
        $desc = $_POST["desc"];
        $update = "UPDATE `produtos` SET `nome`='$name',`descricao`='$desc',`valor`='$value' WHERE id = $id";
        try {
          mysqli_query($conection, $update) or die("erro");
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Produto editado com sucesso!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } catch (\Throwable $th) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao editar produto, tente novamente!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        break;
      case 3:
        $id = $_GET["id"];
        $delete = "DELETE FROM `produtos` WHERE id = $id";
        try {
          mysqli_query($conection, $delete) or die("erro");
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Produto apagado com sucesso!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } catch (\Throwable $th) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao apagar produto, tente novamente!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        break;
    }
    ?>
    <?php
    $query = mysqli_query($conection, "SELECT * FROM `produtos` WHERE 1", $result_mode = MYSQLI_STORE_RESULT);
    ?>
    <?php while ($e = mysqli_fetch_array($query)) { ?>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h5 class="card-title"><?php echo $e['id'] . " - " . $e['nome'] ?></h5>
          </div>
          <div class="col-6 text-end">
            <form action="edit.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $e['id'] ?>">
              <button type="submit" class="btn"><i class="bi bi-pencil-fill"></i></button>
            </form>
          </div>
        </div>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo "R$ " . $e['valor'] ?></h6>
        <p class="card-text"><?php echo $e['descricao'] ?></p>
      </div>
    </div>
    <br>
    <?php } ?>
    <?php mysqli_close($conection); ?>
  </main>



  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>