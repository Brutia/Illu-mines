<!-- File: src/Template/Onglets/edit.ctp -->
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
            <div class="row">
                <div class="col-lg-12 info">
                    Le nom de l'onglet tel qu'il sera vu par les utilisateurs du site.
                </div>
            </div>
            
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Tag</span>
                <?= $this->Form->input('tag', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <div class="row">
                <div class="col-lg-12 info">
                    Le tag d'un onglet est son identifiant, il permet de faire le lien avec les articles qu'il affichera.
                </div>
            </div>
            
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Menu</span>
                <?= $this->Form->input('menu', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <div class="row">
                <div class="col-lg-12 info">
                    Rentrez ici le nom du menu dropdown dans lequel se trouve votre onglet.
                    Si vous laissez vide, l'onglet apparaîtra directement dans la barre de navigation.
                </div>
            </div>
            
            <?= $this->Form->button(__('Sauvegarder l\'onglet'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>