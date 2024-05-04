<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Bookmarks Controller
 *
 * @property \App\Model\Table\BookmarksTable $Bookmarks
 * @method \App\Model\Entity\Bookmark[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookmarksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    /**
     * Codigo Reescrito Funcion index Usuaria logueado
     */
    public function index()
    {
        // Configura la paginación para mostrar solo los marcadores del usuario autenticado
        $this->paginate = [
            'conditions' => [
                'Bookmarks.user_id' => $this->Auth->user('id'),
            ]
        ];

        // Obtiene y establece los marcadores paginados para la vista
        $this->set('bookmarks', $this->paginate($this->Bookmarks));

        // Serializa los marcadores para la vista
        $this->viewBuilder()->setOption('serialize', ['bookmarks']);
    }


    /**
     * View method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookmark = $this->Bookmarks->get($id, [
            'contain' => ['Users', 'Tags'],
        ]);

        $this->set(compact('bookmark'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */

    /**
     * Codigo Reescrito funcion add
     */
    public function add()
    {
        // Crea una nueva entidad de marcador utilizando los datos recibidos del formulario
        $bookmark = $this->Bookmarks->newEntity($this->request->getData());

        // Verifica si la solicitud es de tipo POST (cuando se envía el formulario)
        if ($this->request->is('post')) {
            // Asigna los datos recibidos del formulario a la entidad de marcador
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->getData());

            // Asigna el ID del usuario autenticado al marcador
            $bookmark->user_id = $this->Auth->user('id');

            // Intenta guardar el marcador en la base de datos
            if ($this->Bookmarks->save($bookmark)) {
                // Muestra un mensaje de éxito si el marcador se guarda correctamente
                $this->Flash->success('The bookmark has been saved.');

                // Redirige al usuario a la página de índice de marcadores
                return $this->redirect(['action' => 'index']);
            }

            // Muestra un mensaje de error si no se puede guardar el marcador
            $this->Flash->error('The bookmark could not be saved. Please, try again.');
        }

        // Obtiene la lista de todas las etiquetas disponibles
        $tags = $this->Bookmarks->Tags->find('list')->all();

        // Establece las variables de vista para pasar los datos al formulario de vista
        $this->set(compact('bookmark', 'tags'));

        // Serializa la entidad de marcador para la vista
        $this->viewBuilder()->setOption('serialize', ['bookmark']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    /**
     * Codigo Reescrito Funcion edit
     */
    public function edit($id = null)
    {
        // Obtiene el marcador con el ID proporcionado, incluyendo sus etiquetas relacionadas
        $bookmark = $this->Bookmarks->get($id, [
            'contain' => ['Tags']
        ]);

        // Verifica si la solicitud es de tipo PATCH, POST o PUT (cuando se envía el formulario)
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Asigna los datos recibidos del formulario a la entidad de marcador
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->getData());

            // Asigna el ID del usuario autenticado al marcador
            $bookmark->user_id = $this->Auth->user('id');

            // Intenta guardar el marcador en la base de datos
            if ($this->Bookmarks->save($bookmark)) {
                // Muestra un mensaje de éxito si el marcador se guarda correctamente
                $this->Flash->success('The bookmark has been saved.');

                // Redirige al usuario a la página de índice de marcadores
                return $this->redirect(['action' => 'index']);
            }

            // Muestra un mensaje de error si no se puede guardar el marcador
            $this->Flash->error('The bookmark could not be saved. Please, try again.');
        }

        // Obtiene la lista de todas las etiquetas disponibles
        $tags = $this->Bookmarks->Tags->find('list')->all();

        // Establece las variables de vista para pasar los datos al formulario de vista
        $this->set(compact('bookmark', 'tags'));

        // Serializa la entidad de marcador para la vista
        $this->viewBuilder()->setOption('serialize', ['bookmark']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookmark = $this->Bookmarks->get($id);
        if ($this->Bookmarks->delete($bookmark)) {
            $this->Flash->success(__('The bookmark has been deleted.'));
        } else {
            $this->Flash->error(__('The bookmark could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Codigo agregado duncion tags
     */
    // Acción para manejar las solicitudes relacionadas con las etiquetas de los marcadores
    /*public function tags()
    {
        // Obtiene los parámetros de la solicitud, que son los segmentos de la URL después de la acción
        $tags = $this->request->getParam('pass');

        // Realiza una consulta para encontrar los marcadores etiquetados con las etiquetas proporcionadas
        $bookmarks = $this->Bookmarks->find('tagged', [
            'tags' => $tags
        ])
            ->all();

        // Establece las variables de vista para enviar los datos a la vista
        $this->set([
            'bookmarks' => $bookmarks, // Marcadores encontrados
            'tags' => $tags // Etiquetas proporcionadas
        ]);
    }*/

    // Acción para manejar las solicitudes relacionadas con las etiquetas de los marcadores
    public function tags()
    {
        // Obtiene los parámetros de la solicitud, que son los segmentos de la URL después de la acción
        $tags = $this->request->getParam('pass');

        // Realiza una consulta para encontrar los marcadores etiquetados con las etiquetas proporcionadas
        $bookmarks = $this->Bookmarks->find('tagged', [
            'tags' => $tags
        ])
            ->contain(['Tags']) // Agregamos la relación Tags para que los datos de las etiquetas estén disponibles en la vista
            ->all();

        // Establece las variables de vista para enviar los datos a la vista
        $this->set([
            'bookmarks' => $bookmarks, // Marcadores encontrados
            'tags' => $tags // Etiquetas proporcionadas
        ]);
    }
    /**
     * Codigo agregado Autorizacion
     */
    public function isAuthorized($user)
    {
        // Obtiene el nombre de la acción actual
        $action = $this->request->getParam('action');

        // Acciones que están permitidas para todos los usuarios
        if (in_array($action, ['index', 'add', 'tags'])) {
            return true;
        }

        // Si no se pasa ningún parámetro en la URL, se niega el acceso
        if (!$this->request->getParam('pass.0')) {
            return false;
        }

        // Obtiene el ID del marcador desde la URL
        $id = $this->request->getParam('pass.0');

        // Obtiene el marcador correspondiente al ID
        $bookmark = $this->Bookmarks->get($id);

        // Comprueba si el usuario actual es el propietario del marcador
        if ($bookmark->user_id == $user['id']) {
            return true; // Si el usuario es propietario del marcador, se permite el acceso
        }

        // Si no se cumple ninguna de las condiciones anteriores, se llama al método isAuthorized del controlador padre
        return parent::isAuthorized($user);
    }
}
