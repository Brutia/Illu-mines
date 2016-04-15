<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout']);
    }

     public function index()
     {
        $this->isAuthorized($this->Auth->user());
        $this->set('users', $this->Users->find('all'));
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        $this->isAuthorized($this->Auth->user());
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__("L'utilisateur a été sauvegardé."));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("Impossible d'ajouter l'utilisateur."));
        }
        $this->set('user', $user);
    }
    
    // src/Controller/ArticlesController.php
    public function edit($id = null)
    {
        $this->isAuthorized($this->Auth->user());
        $user = $this->Users->get($id);
                
        if ($this->request->is(['post', 'put'])) {
            $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('L\'utilisateur a été mis à jour.'));
                if($this->Auth->user('role') === 'admin')
                    return $this->redirect(['action' => 'index']);
                else
                    return $this->redirect(['controller' => 'pages', 'action' => 'home']);
            }
            $this->Flash->error(__('Impossible de mettre à jour l\'utilisateur.'));
        }

        $this->set('user', $user);
    }
    
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
        // src/Controller/ArticlesController.php
    public function delete($id = null)
    {
        $this->isAuthorized($this->Auth->user());
                
        $user = $this->Users->get($id);
        if ($id != 1) {
            if($this->Users->delete($user)){
                $this->Flash->success(__("L'utilisateur avec l'id: {0} a été supprimé.", h($id)));
                return $this->redirect(['action' => 'index']);
            }
        }
        else{
            $this->Flash->error(__("Tu ne peux pas supprimer cet utilisateur.", h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public function isAuthorized($user){
        
        if ($this->request->action === 'edit'){
            $userId = (int)$this->request->params['pass'][0];
            
            if( ($userId == 1) && ( (isset($user['id']) && $userId != $user['id']) ) ){
                $this->Flash->error(__("Tu ne peux pas modifier cet utilisateur.", h($id)));
                return $this->redirect(['action' => 'index']);
            }
            
            if( ($userId == $user['id']) || ($user['role'] === 'admin') )
                return true;
        }
        
        return parent::isAuthorized($user);
    }
}