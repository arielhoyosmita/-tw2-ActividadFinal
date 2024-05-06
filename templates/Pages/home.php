<?php $this->layout = 'default'; ?>

<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'WikiTv';
?>
<?= $this->Flash->render() ?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <link rel="icon" href="<?= $this->Url->webroot('img/wikitvlogo.png') ?>" type="image/png">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        .row {
            text-align: center;
        }
        .buttons {
            margin-bottom: 20px;
        }
        .description {
            margin-bottom: 30px;
            font-style: italic;
            text-align: center;
        }
        .title {
            text-align: center;
        }
        .button-image {
            display: block;
            margin: 0 auto 10px; /* Añade margen en la parte inferior para separar la imagen del botón */
        }
    </style>
</head>

<body>
    <main class="main">
        <div class="container">
            <!-- Título y descripción -->
            <h1 class="title">Bienvenido a WikiTv</h1>
            <p class="description">Tu destino para descubrir y compartir tus películas, series y anime favoritos.</p>
            
            <!-- Imagen destacada -->
            <img src="<?= $this->Url->image('wikitv.jpg') ?>" alt="" style="display: block; margin: 0 auto; width: 50%;">

            <!-- Botones y enlaces -->
            <div class="content">
                <div class="row">
                    <div class="column buttons">
                        <h3>Usuario</h3>
                        <p>¡Inicia sesión para guardar tus favoritos!</p>
                        <a href="http://localhost:8765/users/login" class="button">Iniciar sesión</a>
                        <img class="button-image" src="<?= $this->Url->image('user.png') ?>" alt="Imagen Usuario">
                    </div>
                    <div class="column buttons">
                        <h3>Peliculas, Series y Anime</h3>
                        <p>Explora y descubre nuevas películas, series y anime.</p>
                        <a href="http://localhost:8765/bookmarks" class="button">Películas</a>
                        <img class="button-image" src="<?= $this->Url->image('añadir.png') ?>" alt="Imagen Película">
                    </div>
                    <div class="column buttons">
                        <h3>Nuestro catálogo</h3>
                        <p>Explora nuestro extenso catálogo y encuentra tu próxima obsesión.</p>
                        <a href="http://localhost:8765/bookmarks/tagged/" class="button">Catálogo</a>
                        <img class="button-image" src="<?= $this->Url->image('catalogo.jpg') ?>" alt="Imagen Catálogo">
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
