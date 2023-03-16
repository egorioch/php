<?php
namespace App;

class Comment
{
    private User $user;
    private string $content;
    function __construct(User $user, string $content)
    {
        $this->user = $user;
        $this->content = $content;
    }
    public function getUser():User
    {
        return $this->user;
    }
    public function getContent():string
    {
        return $this->content;
    }
    public function setUser(User $user):void
    {
        $this->user = $user;
    }
    public function setContent(string $content):void
    {
        $this->content = $content;
    }
}
