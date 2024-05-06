<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bookmark $bookmark
 */
//solo se cambio la pagina al español de forma manual 
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $bookmark->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Eliminar '), ['action' => 'delete', $bookmark->id], ['confirm' => __('¿Estás seguro de que quieres eliminar # {0}?', $bookmark->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Listas de Peliculas, Series y Anime'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nueva Peliculas, Series o Anime'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookmarks view content">
            <h3><?= h($bookmark->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= $bookmark->has('user') ? $this->Html->link($bookmark->user->email, ['controller' => 'Users', 'action' => 'view', $bookmark->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Título') ?></th>
                    <td><?= h($bookmark->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($bookmark->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Creado') ?></th>
                    <td><?= h($bookmark->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado') ?></th>
                    <td><?= h($bookmark->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descripción') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($bookmark->description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('URL') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($bookmark->url)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Etiquetas Relacionadas') ?></h4>
                <?php if (!empty($bookmark->tags)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Título') ?></th>
                            <th><?= __('Creado') ?></th>
                            <th><?= __('Modificado') ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                        <?php foreach ($bookmark->tags as $tags) : ?>
                        <tr>
                            <td><?= h($tags->id) ?></td>
                            <td><?= h($tags->title) ?></td>
                            <td><?= h($tags->created) ?></td>
                            <td><?= h($tags->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Ver'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                                <?= $this->Html->link(__('Editar'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                                <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('¿Estás seguro de que quieres eliminar # {0}?', $tags->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
