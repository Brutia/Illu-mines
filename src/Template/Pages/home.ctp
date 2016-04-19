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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$connection = ConnectionManager::get('default');

$this->layout = "default";

?>

<div class="container content">
    <div class="row welcome">
        <div class="col-lg-12 text-center" style="position: relative">
            <p>Bienvenue sur le site d'<span class="name-asso">Illu-Mines</span></p>
            <?= $this->Html->image('logo.png', ['class' => 'img img-responsive logo hidden-xs',
                                               'style' => 'left: 0']) ?>
            <?= $this->Html->image('logo.png', ['class' => 'img img-responsive logo hidden-xs',
                                                'style' => 'right: 0']) ?>
        </div>
    </div>
    
    <div class="row">
        <?= $this->element('carroussel'); ?>
    </div>
    
    <div class="row presentation">
        <div class="col-lg-12">
            
            <div class="row">
                <div class="col-lg-12 title">
                    Petite présentation de l'association
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 text-justify">
        Illu-Mines est une association de loi 1901 ayant pour objectif le partage et la diffusion de la culture scientifique pour petits et grands. Créée en 2007, l'association Illu-Mines met en place des ateliers simples et ludiques pour faire des enfants de petits chercheurs en herbes !
        <br>
        Association d'élèves ingénieurs de l'école des Mines de Saint-Etienne du campus Charpak Provence situé à Gardanne, elle compte aujourd'hui une soixantaine d’étudiants motivés pour transmettre les sciences sur le principe de la main à la pâte. Nos animateurs sont des scientifiques bénévoles, ayant reçu une formation de base à l’animation et à la vulgarisation scientifique.
        <br>
        Nous intervenons régulièrement dans les classes pour animer des temps d’activités périscolaires et nous organisons également des évènements grand public avec nos partenaires, comme la fête de la science.                
                </div>
            </div>
            
        </div>        
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            
            <div class="row">
                <div class="col-lg-12 title">
                    Dernier article mis en ligne
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 page-title">
                    <?= $this->Html->link($lastArticle['title'], ['controller' => 'articles', 'action' => 'view', $lastArticle->id]); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 date">
                    <?= $lastArticle['created']->format('F jS, Y') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 article">
                    <?php echo $this->BBCode->render($lastArticle['body']); ?>
                </div>
            </div>
            
        </div>
    </div>
</div>