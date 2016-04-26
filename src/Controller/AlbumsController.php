<?php
// src/Controller/OngletsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

class AlbumsController extends AppController
{   
 
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
    }
    
	public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->LoadModel('Images');
	}
    
    public function index()
    {
        $this->isAuthorized($this->Auth->user());
        
        $albums = $this->Albums->find('all');
        
        $this->set(compact('albums'));
    }
    
    public function add()
    {
        $this->isAuthorized($this->Auth->user());
        $album = $this->Albums->newEntity();
        if ($this->request->is('post')) {
            $album = $this->Albums->patchEntity($album, $this->request->data);            
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('Votre album a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre album.'));
        }
        $this->set('album', $album);
    }
    
    public function edit($id = null)
    {
        $this->isAuthorized($this->Auth->user());
        $album = $this->Albums->get($id);
        
        if ($this->request->is(['post', 'put'])) {
            $this->Albums->patchEntity($album, $this->request->data);
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('Votre album a été mis à jour.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre album.'));
        }

        $this->set('album', $album);
    }
    
    public function delete($id = null)
    {       
        $this->isAuthorized($this->Auth->user());
        
        $album = $this->Albums->get($id);
        if ($this->Albums->delete($album)) {
            $this->Flash->success(__("L'album avec l'id: {0} a été supprimé.", h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public function display($id = null)
    {
        $connection = ConnectionManager::get('default');
        
        $nameAlbum = $this->Albums->get($id)->name;
        $images = $connection
            ->execute('SELECT * FROM images I WHERE I.id_album = :id',
                     ['id' => $id])
            ->fetchAll('assoc');
        
        $this->set(compact('nameAlbum', 'images'));
    }
    
    public function isAuthorized($user){
        if (isset($user['role']) && in_array($user['role'], ['admin', 'author'])) {
            return true;
        }
            
        return parent::isAuthorized($user);
    }
}