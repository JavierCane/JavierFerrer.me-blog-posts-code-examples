<?php

abstract class InvalidLoginException extends \RuntimeException
{
}

class InvalidLoginCredentialsException extends InvalidLoginException
{
    protected $message = 'Invalid credentials';
    protected $code = 2052;
}

class TooManyLoginAttemptsException extends InvalidLoginException
{
    protected $message = 'Too many login attempts';
    protected $code = 2051;
}

class BannedUserLoginException extends InvalidLoginException
{
    protected $message = 'Banned user tried to login';
    protected $code = 2053;
}

class ErrorLogger
{
    public function log($message)
    {
        echo $message;
    }
}

class UsersLogin
{
    /**
     * @var ErrorLogger
     */
    private $errorLogger;

    public function __construct(ErrorLogger $anErrorLogger)
    {
        $this->errorLogger = $anErrorLogger;
    }

    private function checkLogin()
    {
        $this->checkLoginCredentials();
        $this->checkLoginAttempts();
        $this->checkBannedUser();
    }

    private function checkLoginCredentials()
    {
        // ...
        // Some validation to check if the credentials are valid
        // ...
        $hasNotValidCredentials = true;

        if ($hasNotValidCredentials) {
            throw new InvalidLoginCredentialsException();
        }
    }

    private function checkLoginAttempts()
    {
        // ...
        // Some validation to check if the user has attempted too many times to login
        // ...
        $hasTooManyLoginAttempts = false;

        if ($hasTooManyLoginAttempts) {
            throw new TooManyLoginAttemptsException();
        }
    }

    private function checkBannedUser()
    {
        // ...
        // Some validation to check if the user has been banned in this moment
        // ...
        $hasBeenBanned = false;

        if ($hasBeenBanned) {
            throw new BannedUserLoginException();
        }
    }

    public function logIn()
    {
        try {
            $this->checkLogin();
        }
        catch (InvalidLoginException $invalidLoginException) {
            $this->errorLogger->log('[Error ' . $invalidLoginException->getCode() . '] ' . $invalidLoginException->getMessage());
        }

        // Continue with the user login
    }
}

$usersLogin = new UsersLogin(new ErrorLogger());
$usersLogin->logIn();
