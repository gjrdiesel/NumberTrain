<?php

namespace App\Accounts\YouTube;

use App\Accounts\Base;

class Channel extends Base
{
    public $username;
    public $subscribers;
    public $views;

    public $url = 'https://www.youtube.com/channel/%s/about';

    function getFollowers()
    {
        $html = $this->getSource();

        $html = str_after($html, '<span class="about-stat"><b>');
        $html = str_before($html, '</b> subscribers</span>');
        $html = str_replace(',', '', $html);

        $this->subscribers = intval($html);

        $this->account->track($this->subscribers, 'Youtube Subscribers');

        return $this;
    }

    function getAlias()
    {
        $html = $this->getSource();

        $html = str_after($html, '<meta property="og:title" content="');
        $alias = str_before($html, '">');

        $this->account->update(compact('alias'));

        return $this;
    }

    function getViews()
    {
        $html = $this->getSource();

        $html = str_after($html, '<span class="about-stat"> &bull; <b>');
        $html = str_before($html, '</b> views</span>');
        $html = str_replace(',', '', $html);

        $this->views = intval($html);

        $this->account->track($this->subscribers, 'Total Youtube Views');

        return $this;
    }
}
