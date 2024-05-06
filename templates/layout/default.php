<?php
// templates/layout/defaul.php
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

//aqui se cambia el nombre de la pagina 
$cakeDescription = 'WikiTv'; 
?>
<?= $this->Flash->render() ?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>
   </title>
   <link rel="icon" href="<?= $this->Url->webroot('img/wikitvlogo.png') ?>" type="image/png">
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
<nav class="top-nav">
    <!-- Encabezado de la barra de navegación superior -->
    <div class="top-nav-title">
        <!-- Enlace al inicio de la página -->
        <a href="<?= $this->Url->build('/') ?>"><span>Wiki</span>Tv</a>
    </div>
    <!-- Enlaces de la barra de navegación superior -->
    <div class="top-nav-links">
        <?php if ($this->getRequest()->getSession()->check('Auth.User')): ?>
            <!-- Si el usuario está autenticado, muestra un enlace para cerrar sesión -->
            <?= $this->Html->link('Cerrar sesión', ['controller' => 'Users', 'action' => 'logout']) ?>
        <?php else: ?>
            <!-- Si el usuario no está autenticado, muestra enlaces para iniciar sesión y crear una cuenta -->
            <?= $this->Html->link('Iniciar sesión', ['controller' => 'Users', 'action' => 'login']) ?>
            <?= $this->Html->link('Crear cuenta', ['controller' => 'Users', 'action' => 'add']) ?>
        <?php endif; ?>
    </div>
</nav>
<main class="main">
    <!-- Contenedor principal de contenido -->
    <div class="container">
        <!-- Renderiza mensajes flash (si los hay) -->
        <?= $this->Flash->render() ?>
        <!-- Renderiza el contenido específico de la página -->
        <?= $this->fetch('content') ?>
    </div>
</main>
<footer>
    <!-- Pie de página -->
</footer>
</body>

</html>
