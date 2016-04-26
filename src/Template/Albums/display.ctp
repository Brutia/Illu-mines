<!-- File: src/Template/Albums/display.ctp -->
<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            <p>Toutes les images de <i><?= $nameAlbum ?></i></p>
        </div>
    </div>
    
    <div class="row album">
        <div class="row album-name text-center">
            <?= $nameAlbum ?>
        </div>

        <?php
        foreach($images as $image){
        ?>
            <div class="col-lg-3">
                <div class="thumbnail">

                    <?= $this->Html->image($image['name'], ['class' => 'img img-responsive',
                                                            'url' => '/img/'. $image['name']]) ?>
                    
                    <?php
                    if(in_array($user['role'], ['admin', 'author'])){
                    ?>
                    
                    <div class="caption">
                        <div class="row img-info">
                            <div class="col-lg-6 text-center">
                                <span class="fa fa-photo"></span>
                                <?= $image['name'] ?>
                            </div>
                            <div class="col-lg-6 text-center">
                                <span class="fa fa-object-group"></span>
                                <?= $nameAlbum ?>
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
                        <?= $this->Html->link('', ['controller' => 'images', 'action' => 'delete', $image['id']], ['class' => 'fa fa-trash', 'title' => 'Supprimer l\'image']) ?>
                    </div>
                    
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php        
        }
        ?>

    </div>

    
</div>