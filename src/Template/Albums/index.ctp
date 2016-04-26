<!-- File: src/Template/Onglets/index.ctp -->
<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            <p>Tous les albums du site</p>
        </div>
    </div>
    
    <div class="row btn-line">
        <div class="col-lg-12">
            <div class="btn-group">
                <?= $this->Html->link('Ajouter un album', ['action' => 'add'], ['class' => 'btn btn-default']) ?>

                <?= $this->Html->link('Voir toutes les images', ['controller' => 'images', 'action' => 'index'], ['class' => 'btn btn-default']) ?>
                
                <?= $this->Html->link('Ajouter des images', ['controller' => 'images', 'action' => 'add'], ['class' => 'btn btn-default']) ?>
                
            </div>
        </div>
    </div>
    <?php  ?>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Tag</th>
                    <th>Action</th>
                </tr>

                <!-- Ici se trouve l'itération sur l'objet query de nos $articles, l'affichage des infos des articles -->

                <?php foreach ($albums as $album): ?>
                <tr>
                    <td><?= $album->id; ?></td>
                    <td>
                        <?= $album->name; ?>
                    </td>
                    <td>
                        <?= $album->tag ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <?= $this->Html->link('Voir les images de l\'album', 
                                                  ['action' => 'display', $album->id],
                                                  ['class' => 'btn btn-default']) ?>
                            <?= $this->Html->link(
                                'Supprimer',
                                ['action' => 'delete', $album->id],
                                ['class' => 'btn btn-default'])
                            ?>
                            <?= $this->Html->link('Modifier',   ['action' => 'edit', $album->id], 
                                                                ['class' => 'btn btn-default']) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>