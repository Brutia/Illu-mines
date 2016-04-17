<!-- File: src/Template/Onglets/index.ctp -->
<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            <p>Tous les onglets du site</p>
        </div>
    </div>
    
    <div class="row btn-line">
        <div class="col-lg-12">
            <?= $this->Html->link('Ajouter un onglet', ['action' => 'add'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?php  ?>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Tag</th>
                    <th>Action</th>
                </tr>

                <!-- Ici se trouve l'itération sur l'objet query de nos $articles, l'affichage des infos des articles -->

                <?php foreach ($onglets as $onglet): ?>
                <tr>
                    <td><?= $onglet->id; ?></td>
                    <td>
                        <?= $onglet->name; ?>
                    </td>
                    <td>
                        <?= $onglet->tag ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <?= $this->Html->link(
                                'Supprimer',
                                ['action' => 'delete', $onglet->id],
                                ['class' => 'btn btn-default'])
                            ?>
                            <?= $this->Html->link('Modifier',   ['action' => 'edit', $onglet->id], 
                                                                ['class' => 'btn btn-default']) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>