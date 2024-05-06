<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Controlador de Usuarios
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Método Index
     *
     * @return \Cake\Http\Response|null|void Renderiza la vista
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * Método Ver
     *
     * @param string|null $id Id del usuario
     * @return \Cake\Http\Response|null|void Renderiza la vista
     * @throws \Cake\Datasource\Exception\RecordNotFoundException Cuando no se encuentra el registro.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Bookmarks'],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Método Agregar
     *
     * @return \Cake\Http\Response|null|void Redirige al agregar exitoso, renderiza la vista en otro caso.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido guardado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no pudo ser guardado. Por favor, intente de nuevo.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Método Editar
     *
     * @param string|null $id Id del usuario
     * @return \Cake\Http\Response|null|void Redirige al editar exitoso, renderiza la vista en otro caso.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException Cuando no se encuentra el registro.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido guardado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no pudo ser guardado. Por favor, intente de nuevo.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Método Eliminar
     *
     * @param string|null $id Id del usuario
     * @return \Cake\Http\Response|null|void Redirige al índice.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException Cuando no se encuentra el registro.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El usuario no pudo ser eliminado. Por favor, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Método de inicio de sesión
     */
    public function login()
    {
        if ($this->request->is('post')) 
        {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Tu usuario o contraseña es incorrecta.');
        }
    }
    
    /**
     * Inicializar el controlador
     */
    public function initialize(): void
    {
        parent::initialize();

        // Permitir acciones sin autenticación
        $this->Auth->allow(['logout', 'add']);
    }

    /**
     * Método de cierre de sesión
     */
    public function logout()
    {
        $this->Flash->success('Has cerrado sesión.');
        return $this->redirect($this->Auth->logout());
    }  
}
