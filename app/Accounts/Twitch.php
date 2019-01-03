<?php

namespace App\Accounts;

class Twitch extends Base
{
    public $username;
    public $followers;

    public $url = 'https://www.twitch.tv/%s';

    function getFollowers()
    {
        $html = $this->getSource();

        $html = str_after($html, "Followers</span><div class=\"channel-header__item-count tw-flex tw-mg-l-05\"><span class=\"tw-font-size-5\">");
        $html = str_before($html, "</span>");

        dd($html);

        $this->followers = intval($html);

        $this->account->track($this->followers, 'Twitter Followers');

        return $this;
    }
}
