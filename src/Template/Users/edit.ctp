<!-- File: src/Template/Users/edit.ctp -->
<?= $this->Flash->render('auth') ?>

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            Modification d'un utilisateur
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
            <?= $this->Form->button(__('Sauvegarder les changements'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>