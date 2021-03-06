<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Illu-Mines</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Include external files and scripts here (See HTML helper for more info.) -->
<?php

echo $this->Html->css('bootstrap.min.css');
echo $this->Html->css("https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css");
echo $this->Html->css("fileinput.min.css");
echo $this->Html->css("style.css");
echo $this->Html->css("illu-mines.css");

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>

</head>
    <body>
        <?= $this->Flash->render() ?>

        <!-- If you'd like some sort of menu to
        show up on all of your views, include it here -->
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
                <?php
                echo $this->Html->link('Illu-Mines', '/', array('class' => 'navbar-brand'));
                ?>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <?php
                  foreach( $DropMenus as $tag => $menu ){
                    if( is_array($menu) ){
                        echo '<li>';
                        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' .$tag. '<span class="caret"></span></a>';

                        echo '<ul class="dropdown-menu">';

                        foreach($menu as $submenu){
                            echo '<li>';
                            echo $this->Html->link($submenu['name'], ['controller' => 'articles', 'action' => 'categorie', $submenu['tag']]);
                            echo '</li>';
                        }

                        echo '</ul>';
                        echo '</li>';
                    }
                    else{
                        echo '<li>';
                        echo $this->Html->link($menu, ['controller' => 'articles', 'action' => 'categorie', $tag]);
                        echo '</li>';
                    }
                  }
                ?>

                <li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Les albums <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <?php
                          foreach($albums as $album){
                              if($album->tag != 'carroussel'){
                                  echo '<li>';
                                  echo $this->Html->link($album->name, ['controller' => 'albums', 'action' => 'display', $album->id]);
                                  echo '</li>';
                              }
                          }
                          ?>
                      </ul>
                </li>

                <li>
                <?php
                if( $user['role'] == 'admin' ){
                   echo $this->Html->link('', ['controller' => 'onglets', 'action' => 'add'],
                                                ['title' => 'Ajouter un onglet', 'class' => 'fa fa-plus']);

                 } ?>
                </li>

              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li>
                    <?php
                      if ($this->request->session()->read('Auth.User')){
                    ?>
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $user['username'] ?> <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li>
                                <?= $this->Html->link('Modifier mon compte', ['controller' => 'users',
                                                                              'action' => 'edit',
                                                                              $user['id']
                                                                             ]); ?>
                            </li>
                            <li>
                                <?= $this->Html->link('Se déconnecter', ['controller' => 'users', 'action' => 'logout']); ?>
                            </li>
                          </ul>
                      </li>
                    <?php
                          if($user['role'] == 'admin' || 'author'){
                    ?>
                              <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span><span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                        <?php
                                            if($user['role'] == 'admin'){
                                                echo '<li>';
                                                echo $this->Html->link('Voir les utilisateurs', ['controller' => 'users', 'action' => 'index']);
                                                echo '</li>';
                                                echo '<li>';
                                                echo $this->Html->link('Voir les onglets', ['controller' => 'onglets', 'action' => 'index']);
                                                echo '</li>';
                                            }
                                        ?>
                                    <li>
                                        <?= $this->Html->link('Voir les articles', ['controller' => 'articles', 'action' => 'index']); ?>
                                    </li>
                                    <li>
                                        <?= $this->Html->link('Voir les albums', ['controller' => 'albums', 'action' => 'index']); ?>
                                    </li>
                                  </ul>
                              </li>
                    <?php
                          }
                      }
                      else
                        echo $this->Html->link('Se connecter', ['controller' => 'users', 'action' => 'login']);
                    ?>
                  </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

        <!-- Here's where I want my views to be displayed -->
        <?= $this->fetch('content') ?>

        <!-- Add a footer to each displayed page -->
        <div class="footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <p><i class="fa fa-home"></i> 879 avenue de Mimet<br> 13120 Gardanne</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <p><i class="fa fa-phone"></i> 07 68 29 38 29</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="mailto:illu-mines@etu.emse.fr"><i class="fa fa-send"></i> illu-mines@etu.emse.fr</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <p>Performed with CakePhp &copy; Illu-Mines</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="https://www.facebook.com/Illu.Mines.Emse/?fref=ts" class="fa fa-facebook"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->Html->script("jquery.min.js") ?>
        <?= $this->Html->script("bootstrap.min.js") ?>
        <?= $this->Html->script("jquery-ui.min.js") ?>
        <?= $this->Html->script("fileinput.min.js") ?>
        <!-- $this->Html->script("site.js") -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-77083535-1', 'auto');
          ga('send', 'pageview');

        </script>
    </body>

</html>
