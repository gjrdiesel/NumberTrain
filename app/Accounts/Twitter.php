<?php

namespace App\Accounts;

class Twitter extends Base
{
    public $username;
    public $followers;

    public $url = 'https://twitter.com/%s';

    function getFollowers()
    {
        $html = $this->getSource();

        $html = str_after($html, "data-nav=\"followers\"");
        $html = str_before($html, "data-is-compact=\"false\"");
        $html = str_after($html, "data-count=");
        $html = str_replace(['"',' '],'',$html);

        $this->followers = intval($html);

        $this->account->track($this->followers, 'Twitter Followers');

        return $this;
    }
}
