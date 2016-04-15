<!-- src/Template/Users/add.ctp -->
<?= $this->Flash->render() ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            Ajout d'un utilisateur
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 form">
            <?= $this->Form->create($user) ?>
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Username</span>
                <?= $this->Form->input('username', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Password</span>
                <?= $this->Form->input('password', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Role</span>
                <?= $this->Form->input('role', [
                    'options' => ['admin' => 'Admin', 'author' => 'Author'],
                    'label' => false, 'div' => false, 'class' => 'form-control'
                ]) ?>
            </div>
            <?= $this->Form->button(__('Ajouter'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>