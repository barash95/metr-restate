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
class MapForm extends Form
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
     * @var resident\Entity\Map
     */
    private $map = null;

    private $residents;
    
    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $map = null, $residents)
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
        $this->map = $map;
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
            'name' => 'x_pos',
            'options' => [
                'label' => 'X-POS',
            ],
        ]);

        $this->add([
          'type'  => 'text',
          'name' => 'y_pos',
          'options' => [
            'label' => 'Y-POS',
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
          'name'     => 'res_id',
          'required' => true,
          'filters'  => [
            ['name' => 'ToInt'],
          ],
        ]);


        // we require plans only for add resident
        $required = true;
        if ($this->scenario=='update'){
          $required = false;
        }
    }           
}