<?php

namespace App\Accounts;

use App\Account;

class Base
{
    public $url;

    protected $account;
    protected $username;

    function getSource()
    {
        try {
            return cache()->remember(base64_encode($this->getUrl()), 60, function () {
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

    function getUrl()
    {
        return sprintf($this->url, $this->account->username);
    }

    function fetch(Account $account)
    {
        $this->account = $account;

        return $this
            ->setUsername($account->username)
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
