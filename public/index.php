<?php

$link_facebook = 'https://www.facebook.com/profile.php?id=100090956140838';
$link_instagram = 'https://www.instagram.com/laudecicred/';
$link_whatsapp = 'https://wa.me/5589988119704?text=Ol%C3%A1%21+%3A%29';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAUDECI | CRED</title>
    <link rel="stylesheet" href="../assets/reset.min.css">
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../assets/index.css">
    <link rel="shortcut icon" href="../img/icon1.png" type="image/x-icon">
    <style>
        /* -----------------------------------------------
        ESTILIZAR SCROLL DO BODY
        ----------------------------------------------- */
        body::-webkit-scrollbar {
            background-color: white;
            width: 10px;
        }

        body::-webkit-scrollbar-thumb {
            background-color: #555555;
        }

        body::-webkit-scrollbar-thumb:hover {
            background-color: #333333;
        }

        body::-webkit-scrollbar-thumb:active {
            background-color: #333333;
        }

        body::-webkit-scrollbar-corner {
            background-color: #555555;
        }
    </style>
</head>

<body style="margin: 10px 0px 10px 10px; background: white;">
    <div style="background-color: #020a54;">
        <div>
            <img src="../img/logo1.png" style="height: 400px; width: 100%; margin-bottom: 10px;" alt="">
        </div>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php

                $slide = 'style="width: 100%; height: 400px;"';

                ?>
                <div <?= $slide ?> class="carousel-item active">
                    <img src="../img/slide1.png" class="d-block w-100" alt="...">
                </div>
                <div <?= $slide ?> class="carousel-item">
                    <img src="../img/slide2.png" class="d-block w-100" alt="...">
                </div>
                <div <?= $slide ?> class="carousel-item">
                    <img src="../img/slide3.png" class="d-block w-100" alt="...">
                </div>
                <div <?= $slide ?> class="carousel-item">
                    <img src="../img/slide4.png" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
        <div class="conteiner" style="margin-top: 20px;">
            <div class="card-info-banco">
                <div class="card-info-div">
                    <div class="card-banco">
                        <p>
                            CONSIGNADO:
                        </p>
                        Servidores Públicos: Municipal
                        Estaduais e Federal, Aposentados
                        e Pensionistas do INSS
                    </div>
                    <div class="btn-banco">
                        <a href="consignado.php" target="_self" class="btn btn-warning btn-lg" style="width: 300px;">
                            CONSIGNADO
                        </a>
                    </div>
                </div>
                <div class="card-info-div">
                    <div class="card-banco">
                        <p>
                            CRÉDITO PESSOAL:
                        </p>
                        Crédito Salário, Crédito Benefício,
                        Crédito Automático e Antecipação
                        do 13º Salário.
                    </div>
                    <div class="btn-banco">
                        <a href="credito_pessoal.php" target="_self" class="btn btn-warning btn-lg"
                            style="width: 300px;">
                            CRÉDITO PESSOAL
                        </a>
                    </div>
                </div>
                <div class="card-info-div">
                    <div class="card-banco">
                        <p>
                            CONSÓRCIOS:
                        </p>
                        Automóvel ( Motos, Carros, Caminhões e Tratores),
                        Imóveis e Eletrodomésticos
                    </div>
                    <div class="btn-banco">
                        <a href="consorcios.php" target="_self" class="btn btn-warning btn-lg" style="width: 300px;">
                            CONSÓRCIOS
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: flex; width: 100%; height: 250px; background: white;">
            <div style="height: 100%; width: 30%; background: white; color: #020a54;">
                <div style="padding: 20px 10px;">
                    <img src="../img/logo2.png" alt=""
                        style="display: flex; justify-content: center;height: 50%; width: 100%;">
                </div>
                <div style="display: flex; justify-content: space-evenly;">
                    <div>
                        <a style="height: auto; width: auto;" target="_blank" href="<?= $link_facebook ?>">
                            <img src="./img/facebook2.svg" style="width: 40px; margin: 3px;" alt="">
                        </a>
                    </div>
                    <div>
                        <a style="height: auto; width: auto;" target="_blank" href="<?= $link_instagram ?>">
                            <img src="../img/instagram2.svg" style="width: 40px; margin: 3px;" alt="">
                        </a>
                    </div>
                    <div>
                        <a style="height: auto; width: auto;" target="_blank" href="<?= $link_whatsapp ?>">
                            <img src="../img/whatsapp2.svg" style="width: 35px; margin: 3px;" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div
                style="height: 100%; width: 20%; background: white; color: #020a54; display: flex;  align-items: center; justify-content: center;">
                <a style="color: #020a54; font-size: larger;" href="./consignado.php">Simulação Aqui!</a>
            </div>
            <div
                style="height: 100%; width: 20%; background: white; color: #020a54; display: flex; flex-direction: column; align-items: flex-start; justify-content: center;">
                <div style="display: flex;">
                    <span class="material-icons">
                        location_on
                    </span>
                    R. Mal. Pires Ferreira, Nº 489 - Centro / Floriano - PI CEP:64800-840
                </div>
                <div style="display: flex;">
                    <span class="material-icons">
                        smartphone
                    </span>
                    +55 (89) 98811-9704
                </div>
                <div style="display: flex;">
                    <span class="material-icons">
                        mail
                    </span>
                    laudeci.cred22@hotmail.com
                </div>
                <div style="display: flex;">
                    <span class="material-icons">
                        store
                    </span>
                    CNPJ:34472772/0001-48
                </div>
            </div>
            <div style="height: 100%; width: 30%; background: white; color: #020a54;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.013942165177!2d-43.026257083925785!3d-6.768153454687846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7837d325510bc95%3A0x6d3778f385600cbe!2sR.%20Mal.%20P%C3%ADres%20Ferreira%2C%20489%20-%20Centro%2C%20Floriano%20-%20PI%2C%2064800-082!5e0!3m2!1spt-BR!2sbr!4v1678106119736!5m2!1spt-BR!2sbr"
                    style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
        <div style="text-align: center;">
            <footer class="card-footer background-color #020a54">
                <p style="color: white"> A laudecicred não realiza análise de crédito e a liberação do valor na conta do
                    cliente, esta responsabilidade é única e exclusivamente das instituições financeiras parceiras. A
                    aprovação de créditos consignados, crédito pessoal e consórcios descritos nesta plataforma está sujeita a validação de margem
                    consignável e a averbação por parte do órgão pagador de acordo com as políticas das instituições
                    financeiras parceiras. Embora a LaudeciCred trabalhe para democratizar o acesso ao crédito nas
                    melhores condições e taxas de juros praticadas no empréstimo consignado e no cartão de crédito
                    consignado, referidas condições são determinadas pelas instituições financeiras parceiras, as quais
                    deverão ser confirmadas e exibidas antes de qualquer contratação.<br>Todo crédito deve ser utilizado
                    de forma consciente.</br></p>
                <p style="color: white">Todos os Direitos Reservados <cite title="Source Title">@2023</cite></p>
            </footer>
        </div>
        <script src="../assets/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>
