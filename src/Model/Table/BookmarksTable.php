<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bookmarks Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Bookmark newEmptyEntity()
 * @method \App\Model\Entity\Bookmark newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bookmark[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bookmark get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bookmark findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bookmark patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bookmark[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bookmark|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bookmark saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bookmark[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bookmark[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bookmark[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bookmark[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BookmarksTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('bookmarks');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'bookmark_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'bookmarks_tags',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 50)
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('url')
            ->allowEmptyString('url');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    /**
     * Codigo agregado
     */
    // Método personalizado para encontrar marcadores etiquetados
    /*public function findTagged(Query $query, array $options)
    {
        // Verifica si se proporcionaron etiquetas en las opciones
        if (empty($options['tags'])) {
            // Si no se proporcionaron etiquetas, selecciona los marcadores que no tienen etiquetas asociadas
            $bookmarks = $query
                ->select(['Bookmarks.id', 'Bookmarks.url', 'Bookmarks.title', 'Bookmarks.description'])
                ->leftJoinWith('Tags') // Realiza una unión izquierda con la tabla de etiquetas
                ->where(['Tags.title IS' => null]) // Filtra los marcadores que no tienen etiquetas asociadas
                ->group(['Bookmarks.id']); // Agrupa los resultados por el ID del marcador
        } else {
            // Si se proporcionaron etiquetas, selecciona los marcadores que tienen las etiquetas especificadas
            $bookmarks = $query
                ->select(['Bookmarks.id', 'Bookmarks.url', 'Bookmarks.title', 'Bookmarks.description'])
                ->innerJoinWith('Tags') // Realiza una unión interna con la tabla de etiquetas
                ->where(['Tags.title IN ' => $options['tags']]) // Filtra los marcadores que tienen las etiquetas proporcionadas
                ->group(['Bookmarks.id']); // Agrupa los resultados por el ID del marcador
        }

        // Retorna la consulta modificada
        return $query;
    }*/
    // Método personalizado para encontrar marcadores etiquetados con etiquetas específicas
    public function findTagged(Query $query, array $options)
    {
        // Verifica si se proporcionan etiquetas
        if (!empty($options['tags'])) {
            // Filtra los marcadores que tienen al menos una de las etiquetas proporcionadas
            $bookmarks = $query
                ->distinct(['Bookmarks.id']) // Usamos distinct para evitar duplicados
                ->innerJoinWith('Tags')
                ->where(['Tags.title IN ' => $options['tags']]);
        } else {
            // Si no se proporcionan etiquetas, devuelve todos los marcadores
            $bookmarks = $query;
        }

        return $bookmarks;
    }

    /**
     * Codigo Agregado
     */
    // Método beforeSave() para procesar la cadena de etiquetas antes de guardarla
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
    }

    // Método para construir las entidades de etiquetas relacionadas
    protected function _buildTags($tagString)
    {
        // Se eliminan los espacios en blanco alrededor de las etiquetas y se dividen por comas
        $newTags = array_map('trim', explode(',', $tagString));
        // Se eliminan las etiquetas vacías
        $newTags = array_filter($newTags);
        // Se eliminan las etiquetas duplicadas
        $newTags = array_unique($newTags);

        $out = [];
        // Se buscan las etiquetas existentes en la base de datos
        $tags = $this->Tags->find()
            ->where(['Tags.title IN' => $newTags])->all();

        // Se eliminan las etiquetas existentes de la lista de nuevas etiquetas
        foreach ($tags->extract('title') as $existing) {
            $index = array_search($existing, $newTags);
            if ($index !== false) {
                unset($newTags[$index]);
            }
        }
        // Se agregan las etiquetas existentes
        foreach ($tags as $tag) {
            $out[] = $tag;
        }
        // Se crean las nuevas etiquetas
        foreach ($newTags as $tag) {
            $out[] = $this->Tags->newEntity(['title' => $tag]);
        }
        return $out;
    }
}
