<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bookmark $bookmark
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $tags
 */
//solo se cambio la pagina al español de forma manual 
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Listas de Peliculas, Series y Anime'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookmarks form content">
            <?= $this->Form->create($bookmark) ?>
            <fieldset>
                <legend><?= __('Agregar nueva Peliculas, Series o Anime') ?></legend>
                <?php
                    echo $this->Form->control('Título', ['name' => 'title']);
                    echo $this->Form->control('Descripción', ['name' => 'description']);
                    echo $this->Form->control('pagina', ['name' => 'url']);
                    echo $this->Form->control('tags', ['name' => 'tags']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Enviar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
