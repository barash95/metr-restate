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
     * @var resident\Entity\resident
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
            'name' => 'tittle',
            'options' => [
                'label' => 'Заголовок',
            ],
        ]);

        $this->add([
          'type'  => 'text',
          'name' => 'description',
          'options' => [
            'label' => 'Описание',
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
            ['name' => 'StringTrim'],
          ],
          'validators' => [
            [
              'name'    => 'StringLength',
              'options' => [
                'min' => 1,
                'max' => 4
              ],
            ],
          ],
        ]);

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
        $required = true;
        if ($this->scenario=='update'){
          $required = false;
        }
    }           
}