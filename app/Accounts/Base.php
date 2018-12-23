<?php

namespace App\Accounts;

use App\Account;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Laravel\Dusk\Browser;

class Base
{
    public $url;

    protected $account;
    protected $username;

    protected $browser;

    function __construct()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
        ]);

        $driver = RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
            ChromeOptions::CAPABILITY, $options
        )
        );

        $this->browser = new Browser($driver);
    }

    function getSource()
    {

        dd($this->browser->visit($this->getUrl()));

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
