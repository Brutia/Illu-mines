<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            <p>Tous les utilisateurs du site</p>
        </div>
    </div>
    
    <div class="row btn-line">
        <div class="col-lg-12">
            <?= $this->Html->link('Ajouter un utilisateur', ['action' => 'add'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>

                <!-- Ici se trouve l'itération sur l'objet query de nos $articles, l'affichage des infos des articles -->

                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->id; ?></td>
                    <td>
                        <?= $this->Html->link($user->username, ['action' => 'view', $user->id]); ?>
                    </td>
                    <td>
                        <?= $user->role; ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <?= $this->Html->link(
                                'Supprimer',
                                ['action' => 'delete', $user->id],
                                ['class' => 'btn btn-default'])
                            ?>
                            <?= $this->Html->link('Modifier',   ['action' => 'edit', $user->id], 
                                                                ['class' => 'btn btn-default']) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

