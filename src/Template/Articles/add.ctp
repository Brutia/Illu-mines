<!-- File: src/Template/Articles/add.ctp -->

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            Ajout d'un article
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 form">
            <?= $this->Form->create($article) ?>
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Title</span>
                <?= $this->Form->input('title', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <div class="input-group">
                <!-- <span class="input-group-addon addon-fixed-size" id="basic-addon1">Content</span> -->
                <?= $this->Form->input('body', ['label' => false, 'div' => false, 'class' => 'form-control', 'rows' => '60', 'id' => 'body']) ?>
            </div>
            <?= $this->Form->button(__('Sauvegarder l\'article'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
<?= $this->Html->script('plugin.js'); ?>
<script>
    CKEDITOR.replace('body', {
        height: 450,
        language: 'fr',
        extraPlugins: 'bbcode'
    });
    
    CKEDITOR.BBCodeParser();
</script>