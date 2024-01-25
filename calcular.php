<?php

    $n1 = '';
    $n2 = '';

    if (isset($_POST['btn_calcular'])) 
    {
        $url_api = "https://localhost/API_A/consumir.php";

        $n1 = $_POST['n1'];
        $n2 = $_POST['n2'];

        $dados_para_enviar = [
            'n1' => $n1,
            'n2' => $n2
        ];

        $cliente = curl_init();

        curl_setopt($cliente, CURLOPT_URL, $url_api);

        curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($cliente, CURLOPT_POSTFIELDS, $dados_para_enviar);

        
        curl_setopt($cliente, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cliente, CURLOPT_SSL_VERIFYHOST, false);

        $resposta = curl_exec($cliente);

        $resposta = json_decode($resposta, true);

    }

?>

<form method="post" action="calcular.php">
    <label>Número 1</label>
    <input type="number" name="n1" value="<?=$n1?>">
    <br><br>
    <label>Número 2</label>
    <input type="number" name="n2" value="<?=$n2?>">
    <br><br>
    <button  name="btn_calcular">SOMAR</button>
</form>

<?php

    if (isset($resposta)) { ?>
    <hr>
    <label>Status</label>
    <input disabled value="<?= $resposta['STATUS'] ?>">
    <br><br>
    <label>Resultado</label>
    <input disabled value="<?= $resposta['RESULTADO'] ?>">
<?php } ?>
   