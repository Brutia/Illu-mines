<!-- File: src/Template/Articles/index.ctp -->
<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            <p>Tous les articles du site</p>
        </div>
    </div>
    
    <div class="row btn-line">
        <div class="col-lg-12">
            <?= $this->Html->link('Ajouter un article', ['action' => 'add'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?php  ?>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Author</th>
                    <th>Categorie</th>
                    <th>Action</th>
                </tr>

                <!-- Ici se trouve l'itération sur l'objet query de nos $articles, l'affichage des infos des articles -->

                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $article->id; ?></td>
                    <td>
                        <?= $this->Html->link($article->title, ['action' => 'view', $article->id]); ?>
                    </td>
                    <td>
                        <?= $article->created->format('F jS, Y') ?>
                    </td>
                    <td>
                        <?php echo $usernameList[$article->user_id] ?>
                    </td>
                    <td>
                        <?= $article->categorie ?>
                    </td>
                    </td>
                    <td>
                        <div class="btn-group">
                            <?= $this->Html->link(
                                'Supprimer',
                                ['action' => 'delete', $article->id],
                                ['class' => 'btn btn-default'])
                            ?>
                            <?= $this->Html->link('Modifier',   ['action' => 'edit', $article->id], 
                                                                ['class' => 'btn btn-default']) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>