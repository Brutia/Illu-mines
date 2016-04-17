<?php
// src/Controller/OngletsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

class OngletsController extends AppController
{        
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
    }
    
	public function beforeFilter(Event $event){
        parent::beforeFilter($event);
	}
    
    public function index()
    {
        $this->isAuthorized($this->Auth->user());
        
        $onglets = $this->Onglets->find('all');
        
        $this->set(compact('onglets'));
    }
    
    
    public function add()
    {
        $this->isAuthorized($this->Auth->user());
        $onglet = $this->Onglets->newEntity();
        if ($this->request->is('post')) {
            $onglet = $this->Onglets->patchEntity($onglet, $this->request->data);            
            if ($this->Onglets->save($onglet)) {
                $this->Flash->success(__('Votre onglet a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre onglet.'));
        }
        $this->set('onglet', $onglet);
    }
    
    public function edit($id = null)
    {
        $this->isAuthorized($this->Auth->user());
        $onglet = $this->Onglets->get($id);
        
        if ($this->request->is(['post', 'put'])) {
            $this->Onglets->patchEntity($onglet, $this->request->data);
            if ($this->Onglets->save($onglet)) {
                $this->Flash->success(__('Votre onglet a été mis à jour.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre onglet.'));
        }

        $this->set('onglet', $onglet);
    }
    
    public function delete($id = null)
    {       
        $this->isAuthorized($this->Auth->user());
        
        $onglet = $this->Onglets->get($id);
        if ($this->Onglets->delete($onglet)) {
            $this->Flash->success(__("L'onglet avec l'id: {0} a été supprimé.", h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
}