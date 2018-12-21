<?php

namespace App\Accounts;

class Twitter extends Base
{
    public $username;
    public $followers;

    protected $url = 'https://twitter.com/%s';

    function getFollowers()
    {
        $html = $this->getSource();

        $html = str_after($html, "data-nav=\"followers\"");
        $html = str_before($html, "data-is-compact=\"false\"");
        $html = str_after($html, "data-count=");

        $this->followers = intval($html);

        return $this;
    }
}
