<?php
namespace Admin\Validator;

use Zend\Validator\AbstractValidator;
use Admin\Entity\Map;
/**
 * This validator class is designed for checking if map meets certain conditions
 */
class MapExistsValidator extends AbstractValidator
{
    /**
     * Available validator options.
     * @var array
     */
    protected $options = array(
        'entityManager' => null,
        'map' => null
    );
    
    // Validation failure message IDs.
    const EXIST  = 'exist';
        
    /**
     * Validation failure messages.
     * @var array
     */
    protected $messageTemplates = array(
        self::EXIST  => "Карта для этого ЖК уже существует"
    );
    
    /**
     * Constructor.     
     */
    public function __construct($options = null) 
    {
        // Set filter options (if provided).
        if(is_array($options)) {            
            if(isset($options['entityManager']))
                $this->options['entityManager'] = $options['entityManager'];
            if(isset($options['map']))
                $this->options['map'] = $options['map'];
        }
        
        // Call the parent class constructor
        parent::__construct($options);
    }
        
    /**
     * Check if map exists in the db
     */
    public function isValid($value)
    {
        if ($value=='') return true;
        // Get Doctrine entity manager.
        $entityManager = $this->options['entityManager'];
        $map = $entityManager->getRepository(Map::class)
                                ->findOneByResId($value);

        $isValid = ($map['res_id']!=null);
        $this->setMessage($this->messageTemplates[self::EXIST]);
        // If there were an error, set error message.
        if($isValid) {
          $this->error(self::EXIST);
          //return false;
        }

        // Return validation result.
        return $isValid;
    }
}

