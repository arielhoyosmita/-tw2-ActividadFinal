<div style="text-align: center;">
    <h1 class="catalog-title">
        Catálogo
        <?= $this->Text->toList(h($tags)) ?>
    </h1>

    <div class="row">
        <?php $count = 0; ?>
        <?php foreach ($bookmarks as $bookmark): ?>
            <?php if ($count % 3 === 0): ?>
                </div><div class="row">
            <?php endif; ?>
            <article class="bookmark column">
                <h4><?= $this->Html->link($bookmark->title, $bookmark->url, ['class' => 'bookmark-title']) ?></h4>
                <small class="bookmark-url"><?= h($bookmark->url) ?></small>
                <div class="bookmark-description"><?= $this->Text->autoParagraph(h($bookmark->description)) ?></div>
            </article>
            <?php $count++; ?>
        <?php endforeach; ?>
    </div>
</div>
