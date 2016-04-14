<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

class ArticlesController extends AppController
{        
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->helpers(['BBCode']);
    }
	public function beforeFilter(Event $event){
        parent::beforeFilter($event);
		$this->LoadModel('Users');
	}
    
    public function index()
    {
        $articles = $this->Articles->find('all');
        $users = $this->Users->find('all');
        $this->set(compact('articles', 'users'));
    }
    
    public function view($id = null)
    {
        $article = $this->Articles->get($id);
        
        $this->set(compact('article'));
    }
    
    
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            
            $article->user_id = $this->Auth->user('id');
            
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Votre article a été sauvegardé.'), ['key' => 'art']);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre article.'), ['key' => 'art']);
        }
        $this->set('article', $article);
    }
    
    // src/Controller/ArticlesController.php
    public function edit($id = null)
    {
        $this->isAuthorized($this->Auth->user());
        $article = $this->Articles->get($id);
        
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Votre article a été mis à jour.'), ['key' => 'art']);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre article.'), ['key' => 'art']);
        }

        $this->set('article', $article);
    }
    
    public function categorie($cat){
        $query = $this->Articles->find('all')
            ->where(['Articles.categorie' => $cat]);
        
        $articles = $query->all();
        
        $this->set('articles', $articles);
    }
    
    // src/Controller/ArticlesController.php
    public function delete($id)
    {
        $this->isAuthorized($this->Auth->user());
        
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__("L'article avec l'id: {0} a été supprimé.", h($id)), ['key' => 'art']);
            return $this->redirect(['action' => 'index']);
        }
    }

    // src/Controller/ArticlesController.php
    public function isAuthorized($user)
    {
        // Tous les utilisateurs enregistrés peuvent ajouter des articles
        if ($this->request->action === 'add'){
            return true;
        }

        // Le propriétaire d'un article peut l'éditer et le supprimer
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $articleId = (int)$this->request->params['pass'][0];
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}