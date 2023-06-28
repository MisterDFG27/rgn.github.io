
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGN Asesores</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
</head>

<div class="contenedor-header">
    <header>
        <div class="logo">
            <a href="index.php">
                <h1><i class="fa-solid fa-city"></i></h1>
                <p>Inmobiliaria Web</p>
            </a>
        </div>

        <div class="nav-responsive" onclick="mostrarMenuResponsive()">
            <i class="fa-solid fa-bars"></i>
        </div>
        <nav class="" id="nav">
            <a href="index.php">Inicio</a>
            <a href="propiedades.php">Propiedades</a>
            <a href="contacto.php">Contacto</a>
        </nav>

        <div class="info-contacto">
            <span class="info">
                <a href="tel:<?php echo $config['telefono1'] ?>">
                    <i class="fa-solid fa-phone"></i>
                    <span class="numero-telefono"><?php echo $config['telefono1'] ?> </span>
                </a>

            </span>
            <span class="info">
                <?php if ($config['facebook'] != null) : ?>
                    <a href="<?php echo $config['facebook'] ?>"><i class="fa-brands fa-facebook-f"></i></a>
                <?php endif ?>
            </span>
            <span class="info">
                <?php if ($config['twitter'] != null) : ?>
                    <a href="<?php echo $config['twitter'] ?>"><i class="fa-brands fa-twitter"></i></a>
                <?php endif ?>
            </span>
        </div>
    </header>
</div>