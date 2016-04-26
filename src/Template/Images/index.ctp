<!-- File: src/Template/Onglets/index.ctp -->
<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            <p>Toutes les images du site</p>
        </div>
    </div>
    
    <div class="row btn-line">
        <div class="col-lg-12">
            <?= $this->Html->link('Ajouter une image', ['action' => 'add'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php
        foreach($sortedImages as $idAlbum => $images){
    ?>
            <div class="row album">
                <div class="row album-name text-center">
                    <?= $albumsA[$idAlbum] ?>
                </div>
                
                <?php
                foreach($images as $image){
                ?>
                    <div class="col-lg-3">
                        <div class="thumbnail">
                
                            <?= $this->Html->image($image['name'], ['class' => 'img img-responsive']) ?>
                            
                            <div class="caption">
                                <div class="row img-info">
                                    <div class="col-lg-6 text-center">
                                        <span class="fa fa-photo"></span>
                                        <?= $image['name'] ?>
                                    </div>
                                    <div class="col-lg-6 text-center">
                                        <span class="fa fa-object-group"></span>
                                        <?= $albumsA[$image['id_album']] ?>
                                    </div>
                                </div>
                                <div class="row url">
                                    <div class="col-lg-12 text-center" title="url à utiliser pour avoir l'image dans un article">
                                        <span class="fa fa-external-link"></span>
                                        <?= $this->Url->image($image['name']) ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="btn-delete">
                                <?= $this->Html->link('', ['action' => 'delete', $image['id']], ['class' => 'fa fa-trash', 'title' => 'Supprimer l\'image']) ?>
                            </div>
                        </div>
                    </div>
                <?php        
                }
                ?>
                
            </div>
    <?php
        }
    ?>
    
</div>