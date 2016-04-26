<!-- File: src/Template/Onglets/add.ctp -->
<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            Ajout d'un album
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 form">
            <?= $this->Form->create($album) ?>
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Name</span>
                <?= $this->Form->input('name', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <div class="row">
                <div class="col-lg-12 info">
                    Le nom de l'album tel qu'il sera vu par les utilisateurs du site.
                </div>
            </div>
            
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Tag</span>
                <?= $this->Form->input('tag', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <div class="row">
                <div class="col-lg-12 info">
                    Le tag d'un album est son identifiant, il permet de faire le lien avec les images qu'il affichera.
                </div>
            </div>
                
            <?= $this->Form->button(__('Sauvegarder l\'album'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>