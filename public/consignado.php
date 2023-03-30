<?php

$results = '';
$info = '';

$placeholder = 'placeholder="* Campo Obrigatorio"';

require_once('../libs/inc/functions.php');

// -----------------------------------------------
// REQUEST DA FUNÇÃO
// -----------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['text_nome_completo'];
    if (($nome == null) || verify_number($nome)) {
        die(send_response(1, 'Campo nome vazio'));
    }
    $nome = word_case_pre($nome);
    // -----------------------------------------------
    $cpf = $_POST['text_cpf'];
    if (strlen($cpf) < 11) {
        die(send_response(1, 'CPF invalido'));
    }
    $cpf = format_cpf($cpf, $cpf);
    // -----------------------------------------------
    $telefone = $_POST['text_telefone'];
    $telefone = format_tel($telefone);
    if ($telefone == false) {
        die(send_response(1, 'Numero de Telefone invalido'));
    }
    // -----------------------------------------------
    $email = $_POST['text_email'];
    $data_nascimento = $_POST['text_data_nascimento'];
    $nacionalidade = $_POST['text_nacionalidade'];
    // -----------------------------------------------
    $naturalidade = $_POST['text_naturalidade'];
    $naturalidade = estado($naturalidade);
    // -----------------------------------------------
    $agencia = $_POST['text_agencia'];
    if ($agencia == null) {
        die(send_response(1, 'Numero de Agencia vazio'));
    }
    $conta = $_POST['text_conta'];
    if ($conta == null) {
        die(send_response(1, 'Numero de Conta vazio'));
    }
    $valor = $_POST['text_valor'];
    if ($valor == null) {
        die(send_response(1, 'Valor vazio'));
    }
    $descricao = $_POST['text_descricao'];
    // -----------------------------------------------
    // PENDENCIAS
    // -----------------------------------------------
    require_once('../libs/inc/EasyPDO.php');
    require_once('../libs/inc/config.php');

    $bd = new database();

    $params = [
        ':nome' => $nome,
        ':cpf' => $cpf,
        ':telefone' => $telefone,
        ':email' => $email,
        ':data_nascimento' => $data_nascimento,
        ':nacionalidade' => $nacionalidade,
        ':naturalidade' => $naturalidade,
        ':agencia' => $agencia,
        ':conta' => $conta,
        ':valor' => $valor,
        ':descricao' => $descricao,
    ];

    $bd->EXE_NON_QUERY(
        "INSERT INTO consignado VALUES(
                0,
                :nome,
                :cpf,
                :telefone,
                :email,
                :data_nascimento,
                :nacionalidade,
                :naturalidade,
                :agencia,
                :conta,
                :valor,
                :descricao,
                NOW(), 
                NOW(), 
                NULL
            )",
        $params
    );

    echo '<style>form {display: none!importante;}</style>';
    header("Refresh: 5; index.php");
    
    $results = true;
    $color = 'success';
    $info = 'Consignado Enviado com Sucesso!';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAUDECI | CRED CONSIGNADO</title>
    <link rel="stylesheet" href="../assets/reset.min.css">
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <style>
        .form-control::placeholder {
            color: red;
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="row my-5">
            <?php if ($results == true) { ?>
                <div class="alert alert-<?= $color ?> p-2 text-center">
                    <?= $info ?>
                </div>
            <?php } ?>
            <div id="none" class="col-sm-6 offset-sm-3 card bg-light p-4">
                <form action="./consignado.php" method="POST">
                    <div class="alert alert-warning p-2 text-center">
                        <span style="font-weight: bold; font-size: larger;">Não use caracteres especiais em campos obrigatórios</span>
                    </div>
                    <div class="mb-3">
                        <label for="">Nome Completo</label>
                        <input maxlength="30" type="text" <?= $placeholder ?> class="form-control" name="text_nome_completo">
                        <label for="">CPF</label>
                        <input maxlength="11" type="text" <?= $placeholder ?> class="form-control" name="text_cpf">
                        <label for="">Telefone para contato</label>
                        <input maxlength="11" type="text" <?= $placeholder ?> class="form-control" name="text_telefone">
                        <label for="">Email</label>
                        <input maxlength="30" type="email" class="form-control" name="text_email">
                        <label for="">Data de nascimento</label>
                        <input type="date" <?= $placeholder ?> class="form-control" name="text_data_nascimento">
                        <div class="input-group my-3">
                            <label class="input-group-text" for="inputGroupSelect01">Nacionalidade</label>
                            <select name="text_nacionalidade" class="form-select" id="inputGroupSelect01">
                                <option selected value="Brasil">Brasil</option>
                                <option selected value="Estrangeiro">Estrangeiro</option>
                            </select>
                        </div>
                        <div class="input-group my-3">
                            <label class="input-group-text" for="inputGroupSelect01">Naturalidade</label>
                            <select name="text_naturalidade" class="form-select" id="inputGroupSelect01">
                                <option value="AC">(AC) Acreano(a)</option>
                                <option value="AL">(AL) Alagoano(a)</option>
                                <option value="AP">(AP) Amapaense</option>
                                <option value="AM">(AM) Amazonense</option>
                                <option value="BA">(BA) Baiano(a)</option>
                                <option value="CE">(CE) Cearense</option>
                                <option value="DF">(DF) Brasiliense</option>
                                <option value="ES">(ES) Capixaba</option>
                                <option value="GO">(GO) Goiano(a)</option>
                                <option value="MA">(MA) Maranhense</option>
                                <option value="MT">(MT) Mato-grossense</option>
                                <option value="MS">(MS) Sul-mato-grossense</option>
                                <option value="MG">(MG) Mineiro(a)</option>
                                <option value="PA">(PA) Paraense</option>
                                <option value="PB">(PB) Paraibano(a)</option>
                                <option value="PR">(PR) Paranaense</option>
                                <option value="PE">(PE) Pernambucano(a)</option>
                                <option value="PI">(PI) Piauiense</option>
                                <option value="RJ">(RJ) Carioca</option>
                                <option value="RN">(RN) Potiguar</option>
                                <option value="RS">(RS) Gaúcho(a)</option>
                                <option value="RO">(RO) Rondoniense</option>
                                <option value="RR">(RR) Roraimense</option>
                                <option value="SC">(SC) Catarinense</option>
                                <option value="SP">(SP) Paulista</option>
                                <option value="SE">(SE) Sergipano(a)</option>
                                <option value="TO">(TO) Tocantinense</option>
                            </select>
                        </div>
                        <label for="">Agencia</label>
                        <input type="number" <?= $placeholder ?> class="form-control" name="text_agencia">
                        <label for="">Conta</label>
                        <input type="number" <?= $placeholder ?> class="form-control" name="text_conta">
                        <label for="">Valor da simulação</label>
                        <input type="number" <?= $placeholder ?> class="form-control" name="text_valor">
                        <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="text_descricao"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col text-start">
                            <a class="btn btn-md btn-success" href="index.php">Voltar</a>
                        </div>
                        <div class="col text-end">
                            <input class="btn btn-md btn-success" type="submit" value="Enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>