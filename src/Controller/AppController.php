<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */

/**
 * Codigo agregado Clase appcontroller
 */

// Definición de la clase AppController que extiende de Controller
class AppController extends Controller
{
    // Método de inicialización
    public function initialize(): void
    {
        // Carga el componente Flash para mostrar mensajes flash
        $this->loadComponent('Flash');

        // Carga el componente Auth para la autenticación de usuarios
        $this->loadComponent('Auth', [
            'authorize' => 'Controller', // agregamos Controller
            'authenticate' => [
                'Form' => [
                    // Configuración para autenticación usando el formulario
                    'fields' => [
                        'username' => 'email', // Campo para el nombre de usuario (email)
                        'password' => 'password' // Campo para la contraseña
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users', // Controlador utilizado para la acción de inicio de sesión
                'action' => 'login' // Acción de inicio de sesión
            ],
            'unauthorizedRedirect' => $this->referer() // Redirección en caso de acceso no autorizado
        ]);

        // Permite el acceso público a la acción 'display' de cualquier controlador
        $this->Auth->allow(['display']);
    }

    /**
     * Codigo Agregado autorizacion
     */
    public function isAuthorized($user)
    {
        // Este método determina si el usuario tiene permiso para acceder a una acción específica.

        // Por ahora, estamos devolviendo siempre false, lo que significa que ningún usuario tiene permiso.
        return false;
    }
}
