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
            throw new \RuntimeException("Invalid credentials", self::INVALID_LOGIN_CREDENTIALS);
        }

        // ...
        // Some validation to check if the user has attempted too much times to login
        // ...
        $hasTooMuchLoginAttempts = false;

        if ($hasTooMuchLoginAttempts) {
            throw new \RuntimeException("Too much login attempts", self::TOO_MUCH_LOGIN_ATTEMPTS);
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
                case self::TOO_MUCH_LOGIN_ATTEMPTS:
                    $this->errorLogger->log("Too much login attempts");
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
