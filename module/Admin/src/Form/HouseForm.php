<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect house's information. The form
 * can work in two scenarios - 'create' and 'update'.
 */
class HouseForm extends Form
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
     * Current house.
     * @var Admin\Entity\House
     */
    private $house = null;

    private $residents;
    
    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $house = null, $residents = null)
    {
        // Define form name
        parent::__construct('house-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Set binary content encoding.
        $this->setAttribute('enctype', 'multipart/form-data');
        
        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->house = $house;
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
                'label' => 'Номер корпуса',
            ],
        ]);

        $this->add([            
            'type'  => 'number',
            'name' => 'floor',
            'options' => [
                'label' => 'Кол-во этажей',
            ],
        ]);

        $this->add([
          'type'  => 'number',
          'name' => 'section',
          'options' => [
            'label' => 'Кол-во секций',
          ],
        ]);

        $this->add([
            'type'  => 'number',
            'name' => 'total_flat',
            'options' => [
                'label' => 'Квартир в корпусе',
            ],
        ]);

        $this->add([
            'type'  => 'number',
            'name' => 'year',
            'options' => [
                'label' => 'Год сдачи',
            ],
        ]);

        $this->add([
            'type'  => 'file',
            'name' => 'image',
            'attributes' => [
                'id' => 'file'
            ],
            'options' => [
                'label' => 'Фото корпуса (*.jpeg, *.jpg)',
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
          'name'     => 'house',
          'required' => true,
          'filters'  => [
            ['name' => 'ToInt'],
          ],
        ]);

        $inputFilter->add([
           'name'     => 'floor',
           'required' => true,
           'filters'  => [
               ['name' => 'ToInt'],
           ],
        ]);

            $inputFilter->add([
                'name'     => 'section',
                'required' => true,
                'filters'  => [
                    ['name' => 'ToInt'],
                ],
            ]);

                $inputFilter->add([
                    'name'     => 'total_flat',
                    'required' => true,
                    'filters'  => [
                        ['name' => 'ToInt'],
                    ]
                ]);

        $inputFilter->add([
            'name'     => 'year',
            'required' => true,
            'filters'  => [
                ['name' => 'ToInt'],
            ],
            'validators' => [
                [
                    'name'    => 'Between',
                    'options' => [
                        'min' => 2000,
                        'max' => 2050
                    ],
                ],
            ],
        ]);

        // we require plans only for add house
        $required = false;
        if ($this->scenario=='update'){
          $required = false;
        }

        $inputFilter->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'image',
            'required' => $required,
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',
                    'options' => [
                        'mimeType'  => ['image/jpg', 'image/jpeg'] // only *.jpeg files are allowed here
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