<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OrderList Controller
 *
 *
 * @method \App\Model\Entity\OrderList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderListsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('OrderList');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $orderList = $this->paginate($this->OrderLists);

        $response = $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($orderList));

        return $response;
    }

    /**
     * View method
     *
     * @param string|null $id Order List id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderList = $this->OrderLists->get($id, [
            'contain' => [],
        ]);

        $response = $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($orderList));

        return $response;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderList = $this->OrderLists->newEntity();
        if ($this->request->is('post')) {
            $orderList = $this->OrderLists->patchEntity($orderList, $this->request->getData());
            if ($this->OrderLists->save($orderList)) {
                $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($orderList));

                return $response;
            }
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The order list could not be saved. Please, try again.']));
            return $response;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Order List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderList = $this->OrderLists->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderList = $this->OrderLists->patchEntity($orderList, $this->request->getData());
            if ($this->OrderLists->save($orderList)) {
                $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($orderList));

                return $response;
            }
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The order list could not be saved. Please, try again.']));
            return $response;
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Order List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderList = $this->OrderLists->get($id);
        if ($this->OrderLists->delete($orderList)) {
            $response = $this->response
                ->withType('application/json')
                ->withStatus(200)
                ->withStringBody(json_encode(['msg'=> 'The order list has been deleted.']));
            return $response;
        } else {
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The order list could not be deleted. Please, try again.']));
            return $response;
        }
    }
}
