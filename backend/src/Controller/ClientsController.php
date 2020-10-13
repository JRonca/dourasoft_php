<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Client');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $clients = $this->paginate($this->Clients);

        $response = $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($clients));

        return $response;
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $client = $this->Clients->get($id);

        $response = $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($client));

        return $response;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $client = $this->Clients->newEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($client));
                    return $response;
            }
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The client could not be saved. Please, try again.']));
            return $response;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($client));
                return $response;

            }
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The client could not be saved. Please, try again.']));
            return $response;
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $response = $this->response
                ->withType('application/json')
                ->withStatus(200)
                ->withStringBody(json_encode(['msg'=> 'The client has been deleted.']));
            return $response;
        } else {
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The client could not be deleted. Please, try again.']));
            return $response;
        }
    }
}
