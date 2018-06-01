<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Asins Model
 *
 * @method \App\Model\Entity\Asin get($primaryKey, $options = [])
 * @method \App\Model\Entity\Asin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Asin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Asin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Asin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Asin findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AsinsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('asins');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('asin')
            ->maxLength('asin', 255)
            ->requirePresence('asin', 'create')
            ->notEmpty('asin');

        $validator
            ->scalar('ean')
            ->maxLength('ean', 255)
            ->requirePresence('ean', 'create')
            ->allowEmpty('ean');

        $validator
            ->scalar('isbn')
            ->maxLength('isbn', 255)
            ->requirePresence('isbn', 'create')
            ->allowEmpty('isbn');

        $validator
            ->scalar('sku')
            ->maxLength('sku', 255)
            ->requirePresence('sku', 'create')
            ->allowEmpty('sku');

        $validator
            ->scalar('upc')
            ->maxLength('upc', 255)
            ->requirePresence('upc', 'create')
            ->allowEmpty('upc');

        $validator
            ->scalar('marketplace')
            ->maxLength('marketplace', 255)
            ->requirePresence('marketplace', 'create')
            ->notEmpty('marketplace');

        $validator
            ->boolean('suspended')
            ->requirePresence('suspended', 'create')
            ->notEmpty('suspended');

        return $validator;
    }
}
