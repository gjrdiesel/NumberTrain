<?php

namespace App\Accounts;

class Youtube
{
    public $username;
    public $subscribers;

    // TODO: Add the following metrics
    protected $views;
    protected $likes;
    protected $dislikes;
    protected $comments;

    function getSource()
    {
        return cache()->remember("youtube_username_$this->username", 60, function () {
            return file_get_contents("https://www.youtube.com/results?search_query=$this->username");
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

        $html = str_after($html, 'yt-subscriber-count" title="');
        $html = str_before($html, '" aria-label="');

        $this->subscribers = intval($html);

        return $this;
    }

    function fetch(string $username)
    {
        return $this
            ->setUsername($username)
            ->followers();
    }
}
