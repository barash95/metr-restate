<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect mortgage's information. The form
 * can work in two scenarios - 'create' and 'update'.
 */
class MortgageForm extends Form
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
     * @var Admin\Entity\Mortgage
     */
    private $mortgage = null;
    
    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $mortgage = null)
    {
        // Define form name
        parent::__construct('mortgage-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Set binary content encoding.
        $this->setAttribute('enctype', 'multipart/form-data');
        
        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->mortgage = $mortgage;

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
                'label' => 'name',
            ],
        ]);

        $this->add([
          'type'  => 'text',
          'name' => 'percent',
          'options' => [
            'label' => 'percent',
          ],
        ]);

        $this->add([
            'type'  => 'number',
            'name' => 'year',
            'options' => [
                'label' => 'year',
            ],
        ]);

        $this->add([
            'type'  => 'number',
            'name' => 'money',
            'options' => [
                'label' => 'money',
            ],
        ]);

        $this->add([
            'type'  => 'file',
            'name' => 'icon',
            'attributes' => [
                'id' => 'file'
            ],
            'options' => [
                'label' => 'Icon (*.png)',
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
            'name'     => 'percent',
            'required' => true,
            'filters'  => [
                ['name' => 'ToFloat'],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'year',
            'required' => false,
            'filters'  => [
                ['name' => 'ToInt'],
            ],
            'validators' => [
                [
                    'name'    => 'Between',
                    'options' => [
                        'min' => 0,
                        'max' => 100
                    ],
                ],
            ],
        ]);

        // we require plans only for add resident
        $required = false;
        if ($this->scenario=='update'){
          $required = false;
        }

        $inputFilter->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'icon',
            'required' => $required,
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',
                    'options' => [
                        'mimeType'  => ['image/png'] // only *.jpeg files are allowed here
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