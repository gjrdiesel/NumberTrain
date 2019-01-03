<?php

namespace App\Accounts;

use App\Account;
use Spatie\Browsershot\Browsershot;

class Base
{
    public $url;

    protected $account;
    protected $username;

    function getSource()
    {
        return cache()->remember(base64_encode($this->getUrl()), 60, function () {
            return Browsershot::url($this->getUrl())->bodyHtml();
        });
    }

    function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    function getUrl($username = null)
    {
        return sprintf($this->url, $username ?? $this->account->username);
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
