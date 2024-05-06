<h1 style="text-align: center; font-size: 24px; margin-bottom: 20px;">Iniciar sesión</h1>

<div style="max-width: 400px; margin: 0 auto; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; padding: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">

    <?= $this->Form->create() ?>

    <div style="margin-bottom: 20px;">
        <?= $this->Form->control('email', ['label' => ['text' => 'Correo electrónico', 'class' => 'sr-only'], 'class' => 'form-control', 'placeholder' => 'Ingrese su correo electrónico']) ?>
    </div>

    <div style="margin-bottom: 20px;">
        <?= $this->Form->control('password', ['label' => ['text' => 'Contraseña', 'class' => 'sr-only'], 'class' => 'form-control', 'placeholder' => 'Ingrese su contraseña']) ?>
    </div>

    <div style="text-align: center;">
        <?= $this->Form->button('Iniciar sesión', ['class' => 'btn btn-primary', 'style' => 'width: 100%;']) ?>
    </div>

    <?= $this->Form->end() ?>

</div>
