<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect news's information. The form
 * can work in two scenarios - 'create' and 'update'.
 */
class NewsForm extends Form
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
     * @var Admin\Entity\News
     */
    private $news = null;

    private $residents;
    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $news = null, $residents = null)
    {
        // Define form name
        parent::__construct('news-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Set binary content encoding.
        $this->setAttribute('enctype', 'multipart/form-data');
        
        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->news = $news;
        $this->residents = $residents;
        $this->residents[0] = '';
        ksort($this->residents);
        //return var_dump($this->residents);

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
            'type'  => 'text',
            'name' => 'tittle',
            'options' => [
                'label' => 'tittle',
            ],
        ]);

        $this->add([
          'type'  => 'text',
          'name' => 'description',
          'options' => [
            'label' => 'description',
          ],
        ]);

        $this->add([
            'type'  => 'date',
            'name' => 'date',
            'options' => [
                'label' => 'date',
            ],
        ]);

        $this->add([
            'type'  => 'file',
            'name' => 'image',
            'attributes' => [
                'id' => 'file'
            ],
            'options' => [
                'label' => 'image (*.jpeg, *.jpg)',
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
            'name'     => 'tittle',
            'required' => true,
        ]);

        $inputFilter->add([
            'name'     => 'date',
            'required' => true,
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