<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                <a class="nav-link" aria-current="page" href="search.php">Consultar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addProduct.html">Cadastrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active">Editar</a>
            </li>
        </ul>
        <br>
        <form action="search.php" method="POST" class="container mt-2">
            <?php
            include('conection.php');
            $id_search = $_POST['id'];
            $query = mysqli_query($conection, "SELECT * FROM `produtos` WHERE id = $id_search", $result_mode = MYSQLI_STORE_RESULT);
            while ($e = mysqli_fetch_array($query)) {
            ?>
            <input type="hidden" name="id" value="<?php echo $e['id'] ?>">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="inpName" class="form-label">Nome</label>
                        <input type="text" class="form-control" maxlength="50" required id="name" name="name"
                            value="<?php echo $e['nome'] ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <label for="val" class="form-label">Valor</label>
                    <div class="mb-3 input-group">
                        <span class="input-group-text" id="addonValue">R$</span>
                        <input type="number" class="form-control" aria-describedby="addonValue" id="val" name="val"
                            step=".01" value="<?php echo $e['valor'] ?>">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Descrição:</label>
                <textarea class="form-control" id="desc" name="desc" rows="3" maxlength="500"
                    required><?php echo $e['descricao'] ?></textarea>
            </div>
            <div class="text-end">
                <input type="hidden" name="type" value="2">
                <a onclick="del(<?php echo $e['id'] ?>)" class="btn btn-danger">Apagar</a>
                <button type="submit" class="btn btn-primary ms-3">Salvar</button>
            </div>
            <?php } ?>
        </form>
    </main>

    <script>
        function del(id) {
            if (window.confirm("Tem deseja que precisa apagar? ")) {
                window.location.href = "search.php?id=" + id + "&type=3"
            }
        }
    </script>
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>