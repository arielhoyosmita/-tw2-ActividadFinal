<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column column-50 column-offset-25">
        <div class="form-container">
            <h2><?= __('Crear Cuenta') ?></h2>
            <?= $this->Form->create($user) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('email', ['placeholder' => 'Correo Electrónico', 'class' => 'input']);
                    echo $this->Form->control('password', ['placeholder' => 'Contraseña', 'class' => 'input']);
                ?>
            </fieldset>
            <div class="center">
                <?= $this->Form->button(__('Enviar'), ['class' => 'button']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
