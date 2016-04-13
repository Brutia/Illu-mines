<!-- File: src/Template/Articles/view.ctp -->


<h1><?= h($article->title) ?></h1>
<p>
    <?php echo BBCodeHelper::render($article->body); ?>
</p>
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>