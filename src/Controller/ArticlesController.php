<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ArticlesController extends AppController
{
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
                $this->Flash->success(__('Votre article a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre article.'));
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
                $this->Flash->success(__('Votre article a été mis à jour.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre article.'));
        }

        $this->set('article', $article);
    }
    
    // src/Controller/ArticlesController.php
    public function delete($id)
    {
        $this->isAuthorized($this->Auth->user());
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__("L'article avec l'id: {0} a été supprimé.", h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }

    // src/Controller/ArticlesController.php
    public function isAuthorized($user)
    {
        // Tous les utilisateurs enregistrés peuvent ajouter des articles
        if ($this->request->action === 'add') {
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