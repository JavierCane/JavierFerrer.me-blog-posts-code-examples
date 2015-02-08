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
    const INVALID_LOGIN_CREDENTIALS = -1;
    const TOO_MANY_LOGIN_ATTEMPTS = -2;

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
            throw new \RuntimeException("Invalid credentials", self::INVALID_LOGIN_CREDENTIALS);
        }

        // ...
        // Some validation to check if the user has attempted too many times to login
        // ...
        $hasTooManyLoginAttempts = false;

        if ($hasTooManyLoginAttempts) {
            throw new \RuntimeException("Too many login attempts", self::TOO_MANY_LOGIN_ATTEMPTS);
        }
    }

    public function logIn()
    {
        try {
            $this->checkLogin();
        }
        catch (\RuntimeException $loginException) {
            switch ($loginException->getCode()) {
                case self::INVALID_LOGIN_CREDENTIALS:
                    $this->errorLogger->log("Invalid credentials");
                    break;
                case self::TOO_MANY_LOGIN_ATTEMPTS:
                    $this->errorLogger->log("Too many login attempts");
                    break;
                default:
                    throw $loginException;
                    break;
            }
        }
    }
}

$usersLogin = new UsersLogin(new ErrorLogger());
$usersLogin->logIn();
