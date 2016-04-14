<!-- src/Template/Users/login.ctp -->

<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            Se connecter
        </div>
    </div>
    <?= $this->Flash->render('auth') ?>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 form">
            <?= $this->Form->create() ?>
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Username</span>
                <?= $this->Form->input('username', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <div class="input-group">
                <span class="input-group-addon addon-fixed-size" id="basic-addon1">Password</span>
                <?= $this->Form->input('password', ['label' => false, 'div' => false, 'class' => 'form-control']) ?>
            </div>
            <?= $this->Form->button(__('Se connecter'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>