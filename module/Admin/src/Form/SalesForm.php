<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect sales's information. The form
 * can work in two scenarios - 'create' and 'update'.
 */
class SalesForm extends Form
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
     * @var Admin\Entity\Sales
     */
    private $sales = null;

    private $residents;
    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $sales = null, $residents = null)
    {
        // Define form name
        parent::__construct('sales-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Set binary content encoding.
        $this->setAttribute('enctype', 'multipart/form-data');
        
        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->sales = $sales;
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
            'name' => 'title',
            'options' => [
                'label' => 'title',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'subtitle',
            'options' => [
                'label' => 'subtitle',
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
            'name' => 'time',
            'options' => [
                'label' => 'time',
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name' => 'filter',
            'options' => [
                'label' => 'filter',
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
            'name'     => 'time',
            'required' => true,
        ]);

        // we require plans only for add resident
        $required = false;
        if ($this->scenario=='update'){
          $required = false;
        }
    }           
}