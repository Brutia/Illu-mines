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
		$this->LoadModel('Onglets');
        $this->LoadModel('Albums');
        $this->LoadModel('Images');
	}

    public function index($cat = null)
    {
        $this->isAuthorized($this->Auth->user());

        if($cat != null){
            $articles = $this->Articles->find('all')
                ->where(['Articles.categorie' => $cat]);
        }
        else
            $articles = $this->Articles->find('all');

        $users = $this->Users->find('all');
        foreach($users as $user){
            $usernameList[$user->id] = $user->username;
        }

        $onglets = $this->Onglets->find('all');
        foreach($onglets as $onglet){
            $ongletsA[$onglet->tag] = $onglet->name;
        }
        $ongletsA['notDisplayed'] = 'Non affiché';

        $albums = $this->Albums->find('all');
        foreach($albums as $album){
            $albumsA[$album->id] = $album->name;
        }
        $albumsA[null] = 'Pas d\'album';

        $this->set(compact('articles', 'usernameList', 'ongletsA', 'cat', 'albumsA'));
    }

    public function view($id = null)
    {
        $article = $this->Articles->get($id);

        $connection = ConnectionManager::get('default');
        $articleImages = $connection
            ->execute('SELECT I.name FROM images I WHERE I.id_album = :id',
                     ['id' => $article->album_id])
            ->fetchAll('assoc');

        $this->set(compact('article', 'articleImages'));
    }


    public function add()
    {
        $article = $this->Articles->newEntity();

        $onglets = $this->Onglets->find('all');
        foreach($onglets as $onglet){
            $ongletsA[$onglet->tag] = $onglet->name;
        }
        $ongletsA['notDisplayed'] = 'Non affiché';

        $albums = $this->Albums->find('all');
        foreach($albums as $album){
            $albumsA[$album->id] = $album->name;
        }
        $albumsA[null] = 'Pas d\'album';

        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->data);

            $article->user_id = $this->Auth->user('id');

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Votre article a été sauvegardé.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter votre article.'));
        }
        $this->set(compact('article', 'ongletsA', 'albumsA'));
    }

    // src/Controller/ArticlesController.php
    public function edit($id = null)
    {
        $this->isAuthorized($this->Auth->user());

        $article = $this->Articles->get($id);
        $onglets = $this->Onglets->find('all');

        foreach($onglets as $onglet){
            $ongletsA[$onglet->tag] = $onglet->name;
        }
        $ongletsA['notDisplayed'] = 'Ne pas l\'afficher';

        $albums = $this->Albums->find('all');
        foreach($albums as $album){
            $albumsA[$album->id] = $album->name;
        }
        $albumsA[null] = 'Pas d\'album';

        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Votre article a été mis à jour.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible de mettre à jour votre article.'));
        }

        $this->set(compact('article', 'ongletsA', 'albumsA'));
    }

    public function categorie($cat){
        $query = $this->Articles->find('all')
            ->where(['Articles.categorie' => $cat]);

        $articles = $query->all();

        $connection = ConnectionManager::get('default');
        foreach($articles as $article){
            $articleImages = $connection
                ->execute('SELECT I.name FROM images I WHERE I.id_album = :id',
                         ['id' => $article->album_id])
                ->fetchAll('assoc');
            $articlesImages[$article->id] = $articleImages;
        }

        $this->set(compact('articles', 'articlesImages'));
    }

    // src/Controller/ArticlesController.php
    public function delete($id)
    {
        $this->isAuthorized($this->Auth->user());


        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__("L'article avec l'id: {0} a été supprimé.", h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }

    // src/Controller/ArticlesController.php
    public function isAuthorized($user)
    {
        if( isset($user['role']) && in_array($user['role'], ['author', 'admin']) ){
            // Tous les utilisateurs enregistrés peuvent ajouter des articles
            if (in_array($this->request->action, ['add', 'index'])){
                return true;
            }

            // Le propriétaire d'un article peut l'éditer et le supprimer
            if (in_array($this->request->action, ['edit'])) {
                $articleId = (int)$this->request->params['pass'][0];
                if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                    return true;
                }
                else{
                    $this->Flash->error(__("Vous ne pouvez pas modifier cet article.", h($id)));
                    return $this->redirect(['action' => 'index']);
                }
            }
        }

        return parent::isAuthorized($user);
    }
}
