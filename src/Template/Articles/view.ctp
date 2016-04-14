<!-- File: src/Template/Articles/view.ctp -->
<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            <?= h($article->title) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 date">
            <?= $article->created->format('F jS, Y') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 article">
            <?php echo $this->BBCode->render($article->body); ?>
        </div>
    </div>
</div>