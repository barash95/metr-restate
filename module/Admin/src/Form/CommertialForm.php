<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 21.02.2019
 * Time: 16:53
 */

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

class CommertialForm extends Form
{
    /**
     * Scenario ('create' or 'update').
     * @var string
     */
    private $scenario;

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager = null;

    /**
     * Current resident.
     * @var Admin\Entity\Commertial
     */
    private $commertial = null;

    private $residents = null;

    /**
     * Constructor.
     */
    public function __construct($scenario = 'create', $entityManager = null, $commertial = null,$residents = null)
    {
        // Define form name
        parent::__construct('commertial-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Set binary content encoding.
        $this->setAttribute('enctype', 'multipart/form-data');

        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->commertial = $commertial;
        $this->residents = $residents;

        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements()
    {

        $this->add([
            'type'  => 'select',
            'name' => 'res_id',
            'options' => [
                'label' => 'ЖК',
                'value_options' => $this->residents
            ],
        ]);

        $this->add([
            'type'  => 'number',
            'name' => 'house',
            'options' => [
                'label' => 'Корпус',
            ],
        ]);

        $this->add([
            'type'  => 'number',
            'name' => 'floor',
            'options' => [
                'label' => 'Этаж',
            ],
        ]);

        $this->add([
            'type'  => 'number',
            'name' => 'section',
            'options' => [
                'label' => 'Секция',
            ],
        ]);

        $this->add([
            'type'  => 'number',
            'name' => 'number',
            'options' => [
                'label' => 'Номер',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'square',
            'options' => [
                'label' => 'Площадь',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'price',
            'options' => [
                'label' => 'Цена',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'height',
            'options' => [
                'label' => 'Высота потолков',
            ],
        ]);

        $this->add([
            'type'  => 'select',
            'name' => 'finish',
            'options' => [
                'label' => 'Отделака',
                'value_options' => [
                    0 => 'Без отделки',
                    1 => 'С отделкой'
                ]
            ],
        ]);

        $this->add([
            'type'  => 'select',
            'name' => 'state',
            'options' => [
                'label' => 'Статус',
                'value_options' => [
                    0 => 'Помещение свободно',
                    1 => 'Помещение забронировано',
                    2 => 'Помещение продано'
                ]
            ],
        ]);

        $this->add([
            'type'  => 'file',
            'name' => 'plan',
            'attributes' => [
                'id' => 'file'
            ],
            'options' => [
                'label' => 'Планировка кв (*.jpeg, *.jpg)',
            ],
        ]);


        // Add the Submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Добавить'
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter()
    {
        // Create main input filter
        $inputFilter = $this->getInputFilter();

        $inputFilter->add([
            'name' => 'house',
            'required' => true,
            'filters' => [
                ['name' => 'ToInt'],
            ],
        ]);

        $inputFilter->add([
            'name' => 'floor',
            'required' => true,
            'filters' => [
                ['name' => 'ToInt'],
            ],
        ]);

        $inputFilter->add([
            'name' => 'section',
            'required' => true,
            'filters' => [
                ['name' => 'ToInt'],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'square',
            'required' => true,
            'filters'  => [
                ['name' => 'ToFloat'],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'height',
            'required' => true,
            'filters'  => [
                ['name' => 'ToFloat'],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'finish',
            'required' => true,
            'filters'  => [
                ['name' => 'ToInt'],
            ],
            'validators' => [
                ['name'=>'InArray', 'options'=>['haystack'=>[0, 1]]]
            ],
        ]);

        $inputFilter->add([
            'name'     => 'state',
            'required' => true,
            'filters'  => [
                ['name' => 'ToInt'],
            ],
            'validators' => [
                ['name'=>'InArray', 'options'=>['haystack'=>[0, 1, 2]]]
            ],
        ]);

        $inputFilter->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'plan',
            'required' => false,
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',
                    'options' => [
                        'mimeType'  => ['image/jpeg', 'image/jpeg']
                    ]
                ],
            ],
            'filters'  => [
                [
                    'name' => 'FileRenameUpload',
                    'options' => [
                        'target' => './public/data/upload',
                        'useUploadName' => true,
                        'useUploadExtension' => true,
                        'overwrite' => true,
                        'randomize' => false
                    ]
                ]
            ],
        ]);

    }
}