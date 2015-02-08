<?php

class InvalidLoginCredentialsException extends \RuntimeException
{
}

class TooManyLoginAttemptsException extends \RuntimeException
{
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
        // ...
        // Some validation to check if the credentials are valid
        // ...
        $hasNotValidCredentials = true;

        if ($hasNotValidCredentials) {
            throw new InvalidLoginCredentialsException();
        }

        // ...
        // Some validation to check if the user has attempted too many times to login
        // ...
        $hasTooManyLoginAttempts = false;

        if ($hasTooManyLoginAttempts) {
            throw new TooManyLoginAttemptsException();
        }
    }

    public function logIn()
    {
        try {
            $this->checkLogin();
        }
        catch (InvalidLoginCredentialsException $tooManyLoginAttemptsException) {
            $this->errorLogger->log("Invalid credentials");
        }
        catch (TooManyLoginAttemptsException $tooManyLoginAttemptsException) {
            $this->errorLogger->log("Too many login attempts");
        }

        // Continue with the user login
    }
}

$usersLogin = new UsersLogin(new ErrorLogger());
$usersLogin->logIn();
