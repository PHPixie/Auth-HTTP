<?php

namespace PHPixie\AuthHTTP;

class Builder
{
    protected $security;
    protected $httpContextContainer;
    
    protected $providers;
    
    public function __construct($security, $httpContextContainer)
    {
        $this->security             = $security;
        $this->httpContextContainer = $httpContextContainer;
    }
    
    public function providers()
    {
        if($this->providers === null) {
            $this->providers = $this->buildProviders();
        }
        
        return $this->providers;
    }
    
    protected function buildProviders()
    {
        return new Providers(
            $this->security,
            $this->httpContextContainer
        );
    }
}