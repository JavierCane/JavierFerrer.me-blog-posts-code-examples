<?php

class InvalidLoginCredentialsException extends \RuntimeException
{
}

class TooMuchLoginAttemptsException extends \RuntimeException
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
        // Some validation to check if the user has attempted too much times to login
        // ...
        $hasTooMuchLoginAttempts = false;

        if ($hasTooMuchLoginAttempts) {
            throw new TooMuchLoginAttemptsException();
        }
    }

    public function logIn()
    {
        try {
            $this->checkLogin();
        }
        catch (InvalidLoginCredentialsException $tooMuchLoginAttemptsException) {
            $this->errorLogger->log("Invalid credentials");
        }
        catch (TooMuchLoginAttemptsException $tooMuchLoginAttemptsException) {
            $this->errorLogger->log("Too much login attempts");
        }

        // Continue with the user login
    }
}

$usersLogin = new UsersLogin(new ErrorLogger());
$usersLogin->logIn();
