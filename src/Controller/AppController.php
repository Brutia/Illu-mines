<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ]
        ]);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view', 'display', 'categorie']);

        $connection = ConnectionManager::get('default');
        $this->LoadModel('Onglets');
        $this->LoadModel('Images');
        $this->LoadModel('Albums');

        $onglets = $this->Onglets->find('all');
        $albums = $this->Albums->find('all');

        $carrousselImages = $connection
            ->execute('SELECT I.name FROM images I, albums A WHERE I.id_album = A.id AND A.tag = :tag',
                     ['tag' => 'carroussel'])
            ->fetchAll('assoc');

        $user = $this->Auth->user();

        foreach($onglets as $onglet){
            if( isset($onglet->menu) && ($onglet->menu != null) ){
               $DropMenus[$onglet->menu][] = ['tag' => $onglet->tag, 'name' => $onglet->name];
            }
            else
                $DropMenus[$onglet->tag] = $onglet->name;
        }

        $this->set(compact('user', 'DropMenus', 'carrousselImages', 'albums'));
    }

    public function isAuthorized($user)
    {
        // Admin peuvent accéder à chaque action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Par défaut refuser
        $this->Flash->error(__('Vous n\'avez pas les droits pour accéder à cette page.'));
        return $this->redirect(['controller' => 'pages', 'action' => 'home']);
    }
}
