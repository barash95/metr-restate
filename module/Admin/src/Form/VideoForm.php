<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect video's information. The form
 * can work in two scenarios - 'create' and 'update'.
 */
class VideoForm extends Form
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
     * @var Admin\Entity\Video
     */
    private $video = null;

    private $residents;
    
    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $video = null, $residents = null)
    {
        // Define form name
        parent::__construct('video-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Set binary content encoding.
        $this->setAttribute('enctype', 'multipart/form-data');
        
        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->video = $video;
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
            'type'  => 'text',
            'name' => 'tittle',
            'options' => [
                'label' => 'tittle',
            ],
        ]);

        $this->add([
          'type'  => 'text',
          'name' => 'link',
          'options' => [
            'label' => 'link',
          ],
        ]);

        $this->add([
            'type'  => 'date',
            'name' => 'date',
            'options' => [
                'label' => 'date',
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

        // we require plans only for add resident
        $required = false;
        if ($this->scenario=='update'){
          $required = false;
        }

        $inputFilter->add([
            'name'     => 'link',
            'required' => $required,
        ]);

        $inputFilter->add([
            'name'     => 'date',
            'required' => $required,
        ]);

    }           
}