<?php

namespace PHPixie\AuthHTTP\Providers;

class Session extends    \PHPixie\Auth\Providers\Provider\Implementation
              implements \PHPixie\Auth\Providers\Provider\Persistent
{
    protected $httpContextContainer;
    protected $sessionKey;
    
    public function __construct($httpContextContainer, $domain, $name, $configData)
    {
        $this->httpContextContainer = $httpContextContainer;
        
        parent::__construct($domain, $name, $configData);
    }
    
    public function check()
    {
        $session = $this->session();
        $userId = $session->get($this->sessionKey());
        if($userId === null) {
            return null;
        }
        
        $user = $this->repository()->getById($userId);
        if($user === null) {
            $this->forget();
            return null;
        }
        
        $this->domain->setUser($user, $this->name);
        return $user;
    }
    
    public function persist()
    {
        $user = $this->domain->requireUser();
        $this->session()->set($this->sessionKey(), $user->id());
    }
    
    public function forget()
    {
        $this->session()->remove($this->sessionKey());
    }
    
    protected function session()
    {
        $httpContext = $this->httpContextContainer->httpContext();
        return $httpContext->session();
    }
    
    protected function sessionKey()
    {
        if($this->sessionKey === null) {
            $defaultKey = $this->domain->name().'UserId';
            $this->sessionKey = $this->configData->get('key', $defaultKey);
        }
        
        return $this->sessionKey;
    }
}