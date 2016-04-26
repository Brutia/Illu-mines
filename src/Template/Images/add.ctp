<!-- File: src/Template/Images/add.ctp -->
<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            Ajout d'images
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 form">
            <?= $this->Form->create($image, ['enctype' => 'multipart/form-data']) ?>
            
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Album</span>
                <?= $this->Form->input('id_album', [
                    'options' => $albumsA,
                    'label' => false, 'div' => false, 'class' => 'form-control'
                ]) ?>
            </div>
            
            <?= $this->Form->input('image', [
                    'type' => 'file',
                    'label' => false, 'div' => false, 'class' => 'file'
]); ?>
            <div class="row">
                <div class="col-lg-12 info">
                    Choisissez sur votre ordinateur l'image à uploader sur le serveur.
                </div>
            </div>
                        
            <?= $this->Form->button(__('Sauvegarder l\'image'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>