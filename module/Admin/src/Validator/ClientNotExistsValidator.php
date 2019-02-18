<?php
namespace Flat\Validator;

use Zend\Validator\AbstractValidator;
use Flat\Entity\Flat;
use Client\Entity\Client;
/**
 * This validator class is designed for checking if flat meets certain conditions
 */
class ClientNotExistsValidator extends AbstractValidator
{
    /**
     * Available validator options.
     * @var array
     */
    protected $options = array(
        'entityManager' => null,
        'flat' => null
    );
    
    // Validation failure message IDs.
    const NOT_SCALAR  = 'notScalar';
    const CLIENT_NOT_EXIST  = 'wrongClientId';
        
    /**
     * Validation failure messages.
     * @var array
     */
    protected $messageTemplates = array(
        self::NOT_SCALAR  => "ID клиента должен быть скалярным значением",
        self::CLIENT_NOT_EXIST  => "Клиент с таким ID не найден"
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
            if(isset($options['flat']))
                $this->options['flat'] = $options['flat'];
        }
        
        // Call the parent class constructor
        parent::__construct($options);
    }
        
    /**
     * Check if client exists in the db
     */
    public function isValid($value) 
    {
        if(!is_scalar($value)) {
            $this->error(self::NOT_SCALAR);
            return false; 
        }

        if ($value=='') return true;

        // Get Doctrine entity manager.
        $entityManager = $this->options['entityManager'];

        $client = $entityManager->getRepository(Client::class)
                                ->findOneById($value);

        $isValid = ($client!=null);

        // If there were an error, set error message.
        if(!$isValid) {
          $this->error(self::CLIENT_NOT_EXIST);
        }

        // Return validation result.
        return $isValid;
    }
}

