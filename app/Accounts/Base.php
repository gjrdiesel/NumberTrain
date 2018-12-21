<?php

namespace App\Accounts;

class Base
{
    function getSource()
    {
        try {
            return cache()->remember($this->cacheKey(), 60, function () {
                return file_get_contents($this->getUrl());
            });
        } catch (\Exception $e) {
            return '';
        }
    }

    function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    function cacheKey()
    {
        return __CLASS__ . '_' . $this->username;
    }

    function getUrl()
    {
        return $this->url;
    }

    function setUrl($url): self
    {
        $this->url = $url;
        return $this;
    }

    function fetch(string $username)
    {
        return $this
            ->setUsername($username)
            ->setUrl(sprintf($this->url, $username))
            ->grabAllResources();
    }

    private function grabAllResources()
    {
        collect(get_class_methods($this))
            ->filter(function ($method) {
                if (starts_with($method, 'get')) {
                    $this->$method();
                }
            });

        return $this;
    }
}
