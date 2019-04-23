<?php
namespace User\Service;

use PHPMailer\PHPMailer\PHPMailer;
use User\Entity\User;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;

/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class UserManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;  
    
    /**
     * Constructs the service.
     */
    public function __construct($entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * This method adds a new user.
     */
    public function addUser($data) 
    {
        // Do not allow several users with the same email address.
        if($this->checkUserExists($data['email'])) {
            throw new \Exception("Менеджер с email адресом " . $data['$email'] . " уже существует!");
        }
        
        // Create new User entity.
        $user = new User();
        $user->setEmail($data['email']);
        $user->setRole(2); // add as manager

        // Encrypt password and store the password in encrypted state.
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);        
        $user->setPassword($passwordHash);
        
        $user->setStatus($data['status']);
        
        $currentDate = date('Y-m-d H:i:s');
        $user->setDateCreated($currentDate);        
                
        // Add the entity to the entity manager.
        $this->entityManager->persist($user);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $user;
    }
    
    /**
     * This method updates data of an existing user.
     */
    public function updateUser($user, $data) 
    {
        // Do not allow to change user email if another user with such email already exits.
        if($user->getEmail()!=$data['email'] && $this->checkUserExists($data['email'])) {
            throw new \Exception("Менеджер с email адресом " . $data['email'] . " уже существует!");
        }
        
        $user->setEmail($data['email']);
        $user->setStatus($data['status']);        
        
        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }
    
    /**
     * This method checks if at least one user presents, and if not, creates 
     * 'Admin' user with email 'admin@example.com' and password 'Secur1ty'. 
     */
    public function createAdminUserIfNotExists()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);
        if ($user==null) {
            $user = new User();
            $user->setEmail('admin@example.com');
            $bcrypt = new Bcrypt();
            $passwordHash = $bcrypt->create('123321');
            $user->setPassword($passwordHash);
            $user->setStatus(User::STATUS_ACTIVE);
            $user->setDateCreated(date('Y-m-d H:i:s'));
            
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }
    
    /**
     * Checks whether an active user with given email address already exists in the database.     
     */
    public function checkUserExists($email) {
        
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($email);
        
        return $user !== null;
    }
    
    /**
     * Checks that the given password is correct.
     */
    public function validatePassword($user, $password) 
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();
        
        if ($bcrypt->verify($password, $passwordHash)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Generates a password reset token for the user. This token is then stored in database and 
     * sent to the user's E-mail address. When the user clicks the link in E-mail message, he is 
     * directed to the Set Password page.
     */
    public function generatePasswordResetToken($user)
    {
        // Generate a token.
        $token = Rand::getString(32, '0123456789abcdefghijklmnopqrstuvwxyz', true);
        $user->setPasswordResetToken($token);
        
        $currentDate = date('Y-m-d H:i:s');
        $user->setPasswordResetTokenCreationDate($currentDate);  
        
        $this->entityManager->flush();
        
        $subject = 'Восстановление пароля';
            
        $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
        $passwordResetUrl = 'http://' . $httpHost . '/set-password?token=' . $token;

        $body .= 'Перейдите по ссылке ниже, чтобы сбросить пароль:<br>';
        $body .= "$passwordResetUrl<br>";
        $body .= "Если вы не запрашивали изменение пароля, пожалуйста, проигнорируйте это сообщение.<br><br>";
        $body .= "<i>С уважением,<br>Две cтолицы</i><br>";
        
        // Send email to user.
        $this->sendMail($user->getEmail(), $subject, $body);
    }
    
    /**
     * Checks whether the given password reset token is a valid one.
     */
    public function validatePasswordResetToken($passwordResetToken)
    {
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByPasswordResetToken($passwordResetToken);
        
        if($user==null) {
            return false;
        }
        
        $tokenCreationDate = $user->getPasswordResetTokenCreationDate();
        $tokenCreationDate = strtotime($tokenCreationDate);
        
        $currentDate = strtotime('now');
        
        if ($currentDate - $tokenCreationDate > 24*60*60) {
            return false; // expired
        }
        
        return true;
    }
    
    /**
     * This method sets new password by password reset token.
     */
    public function setNewPasswordByToken($passwordResetToken, $newPassword)
    {
        if (!$this->validatePasswordResetToken($passwordResetToken)) {
           return false; 
        }
        
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByPasswordResetToken($passwordResetToken);
        
        if ($user==null) {
            return false;
        }
                
        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);        
        $user->setPassword($passwordHash);
                
        // Remove password reset token
        $user->setPasswordResetToken(null);
        $user->setPasswordResetTokenCreationDate(null);
        
        $this->entityManager->flush();
        
        return true;
    }
    
    /**
     * This method is used to change the password for the given user. To change the password,
     * one must know the old password.
     */
    public function changePassword($user, $data)
    {
        $oldPassword = $data['old_password'];
        
        // Check that old password is correct
        if (!$this->validatePassword($user, $oldPassword)) {
            return false;
        }                
        
        $newPassword = $data['new_password'];
        
        // Check password length
        if (strlen($newPassword)<6 || strlen($newPassword)>64) {
            return false;
        }
        
        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);
        $user->setPassword($passwordHash);
        
        // Apply changes
        $this->entityManager->flush();

        return true;
    }

  public function sendMail($to, $subj, $body, $attachements = null){
    try
    {
      $mail = new PHPMailer();

      $mail->IsSMTP();                           // tell the class to use SMTP
      $mail->CharSet = 'UTF-8';                  // UTF-8 encoding
      $mail->SMTPAuth = true;                    // enable SMTP authentication
      $mail->SMTPDebug = 2;
      $mail->IsHTML(true);
      $mail->Subject = $subj;
      $mail->Body = $body;
      $mail->Port       = 587;                   // set the SMTP server port
      $mail->SMTPSecure = 'tls';                 // secure transfer enabled REQUIRED for GMail
      $mail->Host       = "smtp.gmail.com";      // SMTP server
      $mail->Username   = "atrmediaformess@gmail.com";        // SMTP server username
      $mail->Password   = "N@#0hbn~462v5An7JS";            // SMTP server password

      $mail->AddReplyTo("support@atr-media.ru","Две столицы");
      $mail->From       = "atrmediaformess@gmail.com";
      $mail->FromName   = "Две столицы";
      $mail->WordWrap   = 80; // set word wrap

      $mail->AddAddress($to);
      if (!is_null($attachements))
      {
        foreach($attachements as $att)
          $mail->AddAttachment($att, basename($att));
      }

      if(!$mail->Send()){
        echo "Сообщение не отправлено!";
        echo "Ошибка: " . $mail->ErrorInfo;

        file_put_contents("/var/www/rescom/data/err.log", $mail->ErrorInfo, FILE_APPEND);

        return 0;
      }
    } catch(phpmailerException $e)
    {
      echo "Сообщение не отправлено!";
      echo "Ошибка: " . $e->errorMessage();

      file_put_contents("/var/www/rescom/data/err.log", $e->errorMessage(), FILE_APPEND);

      return 0;
    } catch (Exception $e) {
      echo "Сообщение не отправлено!";
      echo "Ошибка: " . $e->getMessage();

      file_put_contents("/var/www/rescom/data/err.log", $e->getMessage(), FILE_APPEND);

      return 0;
    }
  }
}

