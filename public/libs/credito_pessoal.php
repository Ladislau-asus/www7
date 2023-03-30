<?php

require_once('./inc/EasyPDO.php');
require_once('./inc/config.php');
require_once('./inc/functions.php');
require_once('./inc/request.php');

$filter = $_GET['filter'];

// ------------------------------------------------------------------------
if (!isset($_GET['filter']) || empty($_GET['filter'])) {
    header("Location: ./credito_pessoal.php?filter=active");
    exit;
}

$db = new database();

$table = 'credito_pessoal';

$results = get_all_table($db, $table, $filter);

/* p_data($results); */

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Consumidora - Credito Pesoal</title>
    <?php include('./php/assets.php') ?>
</head>

<body>
    <?php include('./php/header.php') ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <hr>
                <div class="dropdown-center">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filtro
                    </button>
                    <ul class="dropdown-menu">
                        <li class="btn btn-md btn-<?php if ($_GET['filter'] == "all") {$color = "success";} else {$color = "dark";}?><?= $color ?>">
                            <a style="text-decoration: none; font-weight: bold;" class="text-light" href="./credito_pessoal.php?filter=all">Todas as requisições</a>
                        </li>
                        <li class="btn btn-md btn-<?php if ($_GET['filter'] == "active") {$color = "success";} else {$color = "dark";}?><?= $color ?>">
                            <a style="text-decoration: none; font-weight: bold;" class="text-light" href="./credito_pessoal.php?filter=active">Todas as requisições ativas</a>
                        </li>
                        <li class="btn btn-md btn-<?php if ($_GET['filter'] == "inactive") {$color = "success";} else {$color = "dark";}?><?= $color ?>">
                            <a style="text-decoration: none; font-weight: bold;" class="text-light" href="./credito_pessoal.php?filter=inactive">Todas as requisições na lixeira</a>
                        </li>
                    </ul>
                </div>
                <hr class="mb-5">
                <?php if (count($results) == 0): ?>
                    <p class="text-center">Não existem Consignados na base de dados</p>
                <?php else: ?>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>telefone</th>
                                <th>Credito</th>
                                <th>Data</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                            <?php foreach ($results as $result): ?>
                                <tr>
                                    <td>
                                        <?= $result['nome_completo'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        $cpf_array = explode('-', $result['cpf']);

                                        if ($cpf_array[0] == 1) {
                                            $response = 'CPF <v class="text-success" style="font-weight: bold;">Valido</v>';
                                            echo $response;
                                        } else {
                                            $response = 'CPF <v class="text-danger" style="font-weight: bold;">Invalido</v>';
                                            echo $response;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?= $result['telefone'] ?>
                                    </td>
                                    <td>
                                        <?= $result['credito'] ?>
                                    </td>
                                    <td>
                                        <?= str_replace('-', '/', $result['created_at']) ?>
                                    </td>
                                    <td>
                                        <a style="text-decoration: none;"
                                            href="soft.php?table=<?= $table ?>&type=view&id=<?= aes_encrypt($result['id']) ?>"
                                            class="btn btn-md btn-dark rounded text-info" title="vizualizar credito pessoal">
                                            <span class="material-icons">
                                                visibility
                                            </span>
                                        </a>
                                    </td>
                                    <?php if ($result['deleted_at'] == null) { ?>
                                        <td>
                                            <a style="text-decoration: none;"
                                                href="soft.php?table=<?= $table ?>&type=delete&id=<?= aes_encrypt($result['id']) ?>"
                                                class="btn btn-md btn-dark rounded text-danger" title="deletar credito pessoal">
                                                <span class="material-icons">
                                                    delete
                                                </span>
                                            </a>
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <a style="text-decoration: none;"
                                                href="soft.php?table=<?= $table ?>&type=restore&id=<?= aes_encrypt($result['id']) ?>"
                                                class="btn btn-md btn-dark rounded text-warning" title="restaurar credito pessoal apagado">
                                                <span class="material-icons">
                                                    restart_alt
                                                </span>
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p class="text-end">Total Requerido: <strong>
                            <?= count($results) ?>
                        </strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include('./php/footer.php') ?>
</body>

</html>