<!-- Encabezado que muestra las etiquetas de los marcadores -->
<h1>
    Bookmarks tagged with
    <?= $this->Text->toList(h($tags)) ?> <!-- Muestra las etiquetas de los marcadores como una lista -->
</h1>

<!-- Sección que muestra los marcadores etiquetados -->
<section>
    <?php foreach ($bookmarks as $bookmark) : ?> <!-- Itera sobre cada marcador -->
        <article>

            <h4><?= $this->Html->link($bookmark->title, $bookmark->url) ?></h4> <!-- Muestra el título del marcador como un enlace a su URL -->
            <small><?= h($bookmark->url) ?></small> <!-- Muestra la URL del marcador en un tamaño de letra pequeño -->

            <?= $this->Text->autoParagraph(h($bookmark->description)) ?> <!-- Muestra la descripción del marcador con párrafos automáticos -->
        </article>
    <?php endforeach; ?>
</section>