<?php

    $n1 = '';
    $n2 = '';
    $n3 = '';
    $n4 = '';

    if (isset($_POST['btn_calcular'])) {
        
        $url_api = "https://localhost/API_A/calcula_media.php";

        $n1 = $_POST['nota1'];
        $n2 = $_POST['nota2'];
        $n3 = $_POST['nota3'];
        $n4 = $_POST['nota4'];

        $dados = [
            'n1' => $n1,
            'n2' => $n2,
            'n3' => $n3,
            'n4' => $n4
        ];

        $client = curl_init();

        curl_setopt($client, CURLOPT_URL, $url_api);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($client, CURLOPT_POSTFIELDS, $dados);

        curl_setopt($client, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($client, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($client);

        $response = json_decode($response, true);

    }

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Média</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Calculadora de Média</h1>

        <form method="post" action="calcular_media.php" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="nota1">Nota 1</label>
                    <input type="number" class="form-control" id="nota1" name="nota1" required step="0.1" value="<?= $n1 ?>">
                </div>

                <div class="form-group col-md-3">
                    <label for="nota2">Nota 2</label>
                    <input type="number" class="form-control" id="nota2" name="nota2" required step="0.1" value="<?= $n2 ?>">
                </div>

                <div class="form-group col-md-3">
                    <label for="nota3">Nota 3</label>
                    <input type="number" class="form-control" id="nota3" name="nota3" required step="0.1" value="<?= $n3 ?>">
                </div>

                <div class="form-group col-md-3">
                    <label for="nota4">Nota 4</label>
                    <input type="number" class="form-control" id="nota4" name="nota4" required step="0.1" value="<?= $n4 ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="btn_calcular">Calcular Média</button>
        </form>

        <?php if (!empty($response)) { ?>
            <div class="container mt-5">
                <h1>Resultado da Média</h1>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" value="<?= $response['status'] ?>" disabled>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="resultado">Resultado</label>
                            <input type="text" class="form-control" id="resultado" value="<?= $response['resultado'] ?>" disabled>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="situacao">Situação</label>
                            <input type="text" class="form-control" id="situacao" value="<?= $response['situacao'] ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Inclua o jQuery e o Popper.js antes do Bootstrap.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>