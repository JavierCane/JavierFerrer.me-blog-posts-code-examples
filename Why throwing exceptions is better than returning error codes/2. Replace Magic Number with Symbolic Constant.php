<?php

class ErrorLogger
{
    public function log($message)
    {
        echo $message;
    }
}

class UsersLogin
{
    const LOGIN_SUCCESSFUL = 1;
    const INVALID_LOGIN_CREDENTIALS = -1;
    const TOO_MUCH_LOGIN_ATTEMPTS = -2;

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
            return self::INVALID_LOGIN_CREDENTIALS;
        }

        // ...
        // Some validation to check if the user has attempted too much times to login
        // ...
        $hasTooMuchLoginAttempts = false;

        if ($hasTooMuchLoginAttempts) {
            return self::TOO_MUCH_LOGIN_ATTEMPTS;
        }

        return self::LOGIN_SUCCESSFUL;
    }

    public function logIn()
    {
        switch ($this->checkLogin()) {
            case self::INVALID_LOGIN_CREDENTIALS:
                $this->errorLogger->log("Invalid credentials");
                break;
            case self::TOO_MUCH_LOGIN_ATTEMPTS:
                $this->errorLogger->log("Too much login attempts");
                break;
            default:
                // Successful scenario, log in the user
                break;
        }
    }
}

$usersLogin = new UsersLogin(new ErrorLogger());
$usersLogin->logIn();
