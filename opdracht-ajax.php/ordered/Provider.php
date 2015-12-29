<?php
namespace OpdrachtAjax;

class Provider extends \Amen\MySQL\Connection
{
    public function __construct($modelState) {
        parent::__construct($modelState);
        $this->setHostName('studyplanit.com');
        $this->setDatabaseName('mail_service');
        $this->setPassword('cErepovec/');
        $this->setUserName('c11791');
    }
}