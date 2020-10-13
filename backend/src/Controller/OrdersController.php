<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Order');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $orders = $this->paginate($this->Orders);

        $response = $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($orders));

        return $response;
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Clients', 'OrderLists'],
        ]);

        $response = $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($order));

        return $response;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($order));

                return $response;
            }
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The order could not be saved. Please, try again.']));
            return $response;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($order));

                return $response;
            }
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The order could not be saved. Please, try again.']));
            return $response;
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $response = $this->response
                ->withType('application/json')
                ->withStatus(200)
                ->withStringBody(json_encode(['msg'=> 'The order has been deleted.']));
            return $response;
        } else {
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The order could not be deleted. Please, try again.']));
            return $response;
        }
    }
}
