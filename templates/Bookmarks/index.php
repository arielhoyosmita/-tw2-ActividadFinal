<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Bookmark> $bookmarks
 */
//solo se cambio la pagina al español de forma manual 

?>
<div class="bookmarks index content">
    <?= $this->Html->link(__('agregar'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Peliculas, Series y Anime') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('título') ?></th>
                    <th><?= $this->Paginator->sort('creado') ?></th>
                    <th><?= $this->Paginator->sort('modificado') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookmarks as $bookmark): ?>
                <tr>
                    <td><?= $this->Number->format($bookmark->id) ?></td>
                    <td><?= $bookmark->has('user') ? $this->Html->link($bookmark->user->email, ['controller' => 'Users', 'action' => 'view', $bookmark->user->id]) : '' ?></td>
                    <td><?= h($bookmark->title) ?></td>
                    <td><?= h($bookmark->created) ?></td>
                    <td><?= h($bookmark->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $bookmark->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $bookmark->id]) ?>
                        <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $bookmark->id], ['confirm' => __('¿Estás seguro de que deseas eliminar # {0}?', $bookmark->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('último') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de un total de {{count}}')) ?></p>
    </div>
</div>
