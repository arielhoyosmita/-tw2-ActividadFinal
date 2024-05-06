<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bookmark $bookmark
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $tags
 */
//solo se cambio la pagina al español de forma manual

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $bookmark->id],
                ['confirm' => __('¿Estás seguro de que quieres eliminar # {0}?', $bookmark->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Listas de Peliculas, Series y Anime'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookmarks form content">
            <?= $this->Form->create($bookmark) ?>
            <fieldset>
                <legend><?= __('Editar Peliculas, Series o Anime') ?></legend>
                <?php
                    echo $this->Form->control('Título', ['name' => 'title', 'value' => $bookmark->title]);
                    echo $this->Form->control('Descripción', ['name' => 'description', 'value' => $bookmark->description]);
                    echo $this->Form->control('URL', ['name' => 'url', 'value' => $bookmark->url]);
                    echo $this->Form->control('Etiquetas', ['name' => 'tags._ids', 'options' => $tags, 'value' => $bookmark->tags]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Enviar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

