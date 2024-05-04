<?php

declare(strict_types=1);

namespace App\Model\Entity;

/**
 * Codigo agregado clase DefaultPasswordHasher
 */
use Cake\Auth\DefaultPasswordHasher; // Importamos la clase DefaultPasswordHasher para encriptar contraseñas.
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Bookmark[] $bookmarks
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'email' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'bookmarks' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * Codigo agregado encriptar contrasenias
     */
    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher(); // Creamos una nueva instancia del hasher de contraseñas por defecto proporcionado por CakePHP.
        return $hasher->hash($value); // Devolvemos la contraseña encriptada utilizando el método hash() del hasher.
    }
}
