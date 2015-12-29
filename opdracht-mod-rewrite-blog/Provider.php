<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28-12-2015
 * Time: 18:54
 */

namespace OpdrachtArtikels;


class Provider extends \Amen\MySQL\Connection
{
    public function __construct($modelState) {
        parent::__construct($modelState);
        $this->setHostName('localhost:3306');
        $this->setDatabaseName('mod_rewrite');
        $this->setPassword('cohiba');
        $this->setUserName('root');
    }

}