<!-- Encabezado de la página -->
<h1>Login</h1>

<!-- Formulario de inicio de sesión -->
<?= $this->Form->create() ?> <!-- Inicia el formulario -->
<?= $this->Form->control('email') ?> <!-- Campo de entrada para el correo electrónico -->
<?= $this->Form->control('password') ?> <!-- Campo de entrada para la contraseña -->
<?= $this->Form->button('Login') ?> <!-- Botón para enviar el formulario -->
<?= $this->Form->end() ?> <!-- Finaliza el formulario -->