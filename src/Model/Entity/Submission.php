<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Submission Entity
 *
 * @property int $id
 * @property string $student_name
 * @property string $affiliation
 * @property string $issue_name
 * @property string $file_name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Submission extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'student_name' => true,
        'affiliation' => true,
        'issue_name' => true,
        'file_name' => true,
        'created' => true,
        'modified' => true
    ];
}
