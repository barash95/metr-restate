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

class FlatForm extends Form
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
     * @var Admin\Entity\Flat
     */
    private $flat = null;

    private $residents = null;

    /**
     * Constructor.
     */
    public function __construct($scenario = 'create', $entityManager = null, $flat = null,$residents = null)
    {
        // Define form name
        parent::__construct('flat-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Set binary content encoding.
        $this->setAttribute('enctype', 'multipart/form-data');

        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->flat = $flat;
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
            'type'  => 'number',
            'name' => 'size',
            'options' => [
                'label' => 'Кол-во комнат( 0 - студия)',
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