<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Product');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $products = $this->paginate($this->Products);

        $response = $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($products));

        return $response;
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        $response = $this->response
            ->withType('application/json')
            ->withStatus(200)
            ->withStringBody(json_encode($product));

        return $response;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($product));

                return $response;
            }
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The product could not be saved. Please, try again.']));
            return $response;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($product));

                return $response;
            }
            $response = $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode(['msg'=> 'The product could not be saved. Please, try again.']));
            return $response;
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode(['msg'=> 'The product has been deleted.']));
                return $response;
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(500)
                    ->withStringBody(json_encode(['msg'=> 'The product could not be deleted. Please, try again.']));
                    return $response;
        }
    }
}
