<!-- File: src/Template/Onglets/add.ctp -->
<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            Ajout d'un onglet
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 form">
            <?= $this->Form->create($onglet) ?>
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Name</span>
                <?= $this->Form->input('name', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Tag</span>
                <?= $this->Form->input('tag', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <?= $this->Form->button(__('Sauvegarder l\'onglet'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>