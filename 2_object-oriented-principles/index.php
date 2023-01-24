<?php

class TeamException extends Exception
{
    public static function fromTooManyMembers()
    {
        return new static('You may not add more than 3 members!');
    }
}

class Member
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

class Team
{
    protected $members = [];

    public function add(Member $member)
    {
        if (count($this->members) === 3) {
            throw TeamException::fromTooManyMembers();
        }

        $this->members[] = $member;
    }

    public function members()
    {
        return $this->members;
    }
}

$team = new Team;

$team->add(new Member('Jane Doe'));
$team->add(new Member('John Doe'));
$team->add(new Member('Frank Doe'));
$team->add(new Member('Susan Doe'));

var_dump($team->members());
