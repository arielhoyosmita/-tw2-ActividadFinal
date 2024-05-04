<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Bookmarks'],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Codigo agregado Metodo Login
     */
    public function login()
    {
        // Verifica si la solicitud es de tipo POST (cuando se envía el formulario de inicio de sesión)
        if ($this->request->is('post')) {
            // Intenta identificar al usuario utilizando el componente Auth
            $user = $this->Auth->identify();

            // Si se identifica un usuario válido
            if ($user) {
                // Establece la sesión de usuario utilizando el componente Auth
                $this->Auth->setUser($user);

                // Redirige al usuario a la página a la que intentaba acceder antes del inicio de sesión (o a la página predeterminada)
                return $this->redirect($this->Auth->redirectUrl());
            }

            // Si no se identifica un usuario válido, muestra un mensaje de error
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    /**
     * Codigo Agregado Incializacion Login
     */
    public function initialize(): void
    {
        parent::initialize(); // Llama al método initialize() del controlador padre

        // Permite que los usuarios accedan a la acción 'logout' sin necesidad de iniciar sesión
        $this->Auth->allow(['logout', 'add']); // Permite que los usuarios accedan a las acciones 'logout' y 'add' sin necesidad de iniciar sesión
    }

    public function logout()
    {
        // Muestra un mensaje de éxito indicando que el usuario ha cerrado sesión
        $this->Flash->success('You are now logged out.');

        // Redirige al usuario a la página de inicio de sesión después de cerrar sesión
        return $this->redirect($this->Auth->logout());
    }
}
