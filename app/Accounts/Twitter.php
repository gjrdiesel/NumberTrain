<?php

namespace App\Accounts;

class Twitter
{
    public $username;
    public $followers;


    function getSource()
    {
        return cache()->remember("twitter_$this->username", 60, function () {
            return file_get_contents("https://twitter.com/$this->username");
        });
    }

    function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    function followers()
    {
        $html = $this->getSource();

        $html = str_after($html, "data-nav=\"followers\"");
        $html = str_before($html, "data-is-compact=\"false\"");
        $html = str_after($html, "data-count=");

        $this->followers = intval($html);

        return $this;
    }

    function fetch(string $username)
    {
        return $this
            ->setUsername($username)
            ->followers();
    }
}
