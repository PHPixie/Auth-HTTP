<?php

namespace PHPixie\AuthHTTP;

class Providers extends \PHPixie\Auth\Providers\Builder\Implementation
{
    protected $security;
    protected $httpContextContainer;
    
    public function __construct($security, $httpContextContainer)
    {
        $this->security             = $security;
        $this->httpContextContainer = $httpContextContainer;
    }
    
    public function buildCookieProvider($domain, $name, $configData)
    {
        return new Providers\Cookie(
            $this->security->tokens(),
            $this->httpContextContainer,
            $domain,
            $name,
            $configData
        );
    }
    
    public function buildSessionProvider($domain, $name, $configData)
    {
        return new Providers\Session(
            $this->httpContextContainer,
            $domain,
            $name,
            $configData
        );
    }
    
    public function name()
    {
        return 'http';
    }
}