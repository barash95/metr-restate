<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect resident's information. The form
 * can work in two scenarios - 'create' and 'update'.
 */
class ResidentForm extends Form
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
     * @var Admin\Entity\Resident
     */
    private $resident = null;
    
    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $resident = null)
    {
        // Define form name
        parent::__construct('resident-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Set binary content encoding.
        $this->setAttribute('enctype', 'multipart/form-data');
        
        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->resident = $resident;

        $this->addElements();
        $this->addInputFilter();          
    }
    
    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() 
    {
        $this->add([
          'type'  => 'text',
          'name' => 'name',
          'options' => [
            'label' => 'Название ЖК',
          ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'link',
            'options' => [
                'label' => 'Ссылка на фид',
            ],
        ]);

        $this->add([            
            'type'  => 'text',
            'name' => 'tittle',
            'options' => [
                'label' => 'Заголовок',
            ],
        ]);

        $this->add([
          'type'  => 'textarea',
          'name' => 'description',
          'options' => [
            'label' => 'Описание',
          ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'tittle1',
            'options' => [
                'label' => 'Заголовок 1 для плиток',
            ],
        ]);

        $this->add([
            'type'  => 'textarea',
            'name' => 'description1',
            'options' => [
                'label' => 'Описание 1 для плиток',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'tittle2',
            'options' => [
                'label' => 'Заголовок 2 для плиток',
            ],
        ]);

        $this->add([
            'type'  => 'textarea',
            'name' => 'description2',
            'options' => [
                'label' => 'Описание 2 для плиток',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'tittle3',
            'options' => [
                'label' => 'Заголовок 3 для плиток',
            ],
        ]);

        $this->add([
            'type'  => 'textarea',
            'name' => 'description3',
            'options' => [
                'label' => 'Описание 3 для плиток',
            ],
        ]);

        $this->add([            
            'type'  => 'text',
            'name' => 'metro',
            'options' => [
                'label' => 'Ближайшее метро',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'region',
            'options' => [
                'label' => 'Район',
            ],
        ]);

        $this->add([
          'type'  => 'text',
          'name' => 'address',
          'options' => [
            'label' => 'Адрес ЖК',
          ],
        ]);

        $this->add([
          'type'  => 'number',
          'name' => 'housing',
          'options' => [
            'label' => 'Корпусов',
          ],
        ]);

        $this->add([
          'type'  => 'number',
          'name' => 'total_flat',
          'options' => [
            'label' => 'Всего кв',
          ],
        ]);

        $this->add([
          'type'  => 'select',
          'name' => 'state',
          'options' => [
            'label' => 'Статус',
            'value_options' => [
              0 => 'В продаже',
              1 => 'Скоро в продаже',
              2 => 'Сдан',
            ]
          ],
        ]);

        $this->add([
            'type'  => 'file',
            'name' => 'complex',
            'attributes' => [
                'id' => 'file'
            ],
            'options' => [
                'label' => 'Картинка ЖК (*.jpeg, *.jpg)',
            ],
        ]);

        $this->add([
            'type'  => 'file',
            'name' => 'complex1',
            'attributes' => [
                'id' => 'file'
            ],
            'options' => [
                'label' => 'Для плиток (*.png)',
            ],
        ]);

        $this->add([
            'type'  => 'file',
            'name' => 'complex2',
            'attributes' => [
                'id' => 'file'
            ],
            'options' => [
                'label' => 'Для плиток (*.png)',
            ],
        ]);

        $this->add([
            'type'  => 'file',
            'name' => 'complex3',
            'attributes' => [
                'id' => 'file'
            ],
            'options' => [
                'label' => 'Для плиток (*.png)',
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
          'name'     => 'housing',
          'required' => true,
          'filters'  => [
            ['name' => 'ToInt'],
          ],
          'validators' => [
            [
              'name'    => 'Between',
              'options' => [
                'min' => 1,
                'max' => 10
              ],
            ],
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


        // we require plans only for add resident
        $required = false;
        if ($this->scenario=='update'){
          $required = false;
        }

        $inputFilter->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'complex',
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

        $inputFilter->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'complex1',
            'required' => false,
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',
                    'options' => [
                        'mimeType'  => ['image/png']
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

        $inputFilter->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'complex2',
            'required' => false,
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',
                    'options' => [
                        'mimeType'  => ['image/png']
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

        $inputFilter->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'complex3',
            'required' => false,
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',
                    'options' => [
                        'mimeType'  => ['image/png']
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