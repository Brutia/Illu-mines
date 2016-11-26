<?php
// src/Controller/OngletsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\View\Helper\UrlHelper;

class ImagesController extends AppController
{
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
    }
    
	public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->LoadModel('Albums');
	}
    
    public function index()
    {
        $this->isAuthorized($this->Auth->user());
        
        $images = $this->Images->find('all');
        $albums = $this->Albums->find('all');
        
        foreach($albums as $album){
            $albumsA[$album->id] = $album->name;
        }
        $albumsA[0] = 'Aucun album';
        
        foreach($images as $image){
            $sortedImages[$image->id_album][] = $image->toArray();
        }
                
        $this->set(compact('albumsA', 'sortedImages'));
        
    }
    
    public function add()
    {
        $this->isAuthorized($this->Auth->user());
        $image = $this->Images->newEntity();
        
        $albums = $this->Albums->find('all');
        foreach($albums as $album){
            $albumsA[$album->id] = $album->name;
        }
        $albumsA[0] = 'Aucun album';
        
        if ($this->request->is('post')) {
            $ext_availables = ['png', 'jpg', 'jpeg', 'gif'];
            $id_album = $this->request->data['id_album'];
            $images = $this->request->data['images'];
            print_r($images);
            
            foreach($images as $image_up)
            {              
                $image = $this->Images->newEntity();
                
                $image->id_album = $id_album;
                $image->name = $image_up['name'];
                
                $extension=strrchr($image_up['name'],'.');
                $extension=substr($extension,1);    
                
                if(in_array($extension, $ext_availables)){
                    if ($this->Images->save($image)){
                        move_uploaded_file($image_up['tmp_name'], 'img/' . $image_up['name']);
                        $this->Flash->success(__('Votre image a été sauvegardée.'));
                        //return $this->redirect(['action' => 'index']);
                    }
                }
                else
                    $this->Flash->error(__('Impossible d\'ajouter votre image.'));
            }
            //$image->id_album = $this->request->data['id_album'];
            //$image->name = $this->request->data['image']['name'];
            
            //$extension=strrchr($this->request->data['image']['name'],'.');
            //$extension=substr($extension,1);    
            //$ext_availables = ['png', 'jpg', 'jpeg', 'gif'];
            
            //if(in_array($extension, $ext_availables)){
            //    if ($this->Images->save($image)){
            //        move_uploaded_file($this->request->data['image']['tmp_name'], 'img/' . $this->request->data['image']['name']);
            //        $this->Flash->success(__('Votre image a été sauvegardée.'));
                    //return $this->redirect(['action' => 'index']);
            //    }
            //}
        }
        
        $this->set(compact('albumsA', 'image'));
    }
    
    public function edit($id = null)
    {
        $this->isAuthorized($this->Auth->user());
        $image = $this->Images->get($id);
        
        if ($this->request->is(['post', 'put'])) {
            $this->Images->patchEntity($image, $this->request->data);
            if ($this->Images->save($image)) {
                $this->Flash->success(__('Votre image a été mise à jour.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre image.'));
        }

        $this->set('image', $image);
    }
    
    public function delete($id = null)
    {       
        $this->isAuthorized($this->Auth->user());
        
        $image = $this->Images->get($id);
        
        $file = new File('img/'.$image->name);
        
        if ($this->Images->delete($image) && $file->delete()) {
            $this->Flash->success(__("L'image avec l'id: {0} a été supprimé.", h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
    
    public function isAuthorized($user){
        if (isset($user['role']) && in_array($user['role'], ['admin', 'author'])) {
            return true;
        }
            
        return parent::isAuthorized($user);
    }
}
