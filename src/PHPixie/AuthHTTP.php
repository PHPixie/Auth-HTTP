<?php

namespace PHPixie;

class AuthHTTP
{
    protected $builder;
    
    public function __construct(
        $security,
        $httpContextContainer
    )
    {
        $this->builder = $this->buildBuilder(
            $security,
            $httpContextContainer
        );
    }
    
    public function providers()
    {
        return $this->builder->providers();
    }
    
    public function builder()
    {
        return $this->builder;
    }
    
    protected function buildBuilder(
        $security,
        $httpContextContainer
    )
    {
        return new AuthHTTP\Builder(
            $security,
            $httpContextContainer
        );
    }
}