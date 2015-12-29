<?php
/**
Connection class
@since 10 april 2012
@lastmodified 15 april 2015
@author JI
@version 1.0
 */

// name of namespace should be semantically meaningfull:
// cover the domain of the code
namespace Amen\MySQL;


class Connection
{
    // design means identifying data and methods
    protected $feedback;
    protected $databaseName;
    protected $pdo;
    protected $userName;
    protected $hostName;
    protected $password;

    /**
     * @return mixed
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param mixed $feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @return mixed
     */
    public function getDatabaseName()
    {
        return $this->databaseName;
    }

    /**
     * @param mixed $databaseName
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;
    }

    /**
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param mixed $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getHostName()
    {
        return $this->hostName;
    }

    /**
     * @param mixed $hostName
     */
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function isConnected()
    {
        return ($this->pdo ? TRUE : false);
    }

    // constructor wordt uitgevoerd met
    // het new keyword
    public function __construct(\Amen\Dialog\Model\Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Maakt een connectie met de database
     * @return Bool true als de connectie is gelukt, false als mislukt
     */
    public function open()
    {
        $this->feedback->startTimeInKey('open connection');
        if ($this->pdo)
        {
            $this->feedback->setText("Verbinding met {$this->hostName} met {$this->databaseName} is reeds gemaakt");
            $this->feedback->log();
        }
        else
        {
            try
            {
                $connectionString =
                    "mysql:host={$this->hostName};dbname={$this->databaseName}";
                // je moet aangeven dat de PDO klasse in de root namespace
                // gezocht moet worden in niet in MyBib\Dal
                $this->pdo = new \PDO($connectionString, $this->userName, $this->password);
                $this->feedback->setText("Verbinding met {$this->hostName} met {$this->databaseName} is geslaagd");
                $this->feedback->setCodeDriver('ModernWays DAL Connection');
                $this->feedback->log();
            }
            catch (\PDOException $e)
            {
                $this->feedback->setText("Verbinding met {$this->hostName} met {$this->databaseName} is geslaagd");
                $this->feedback->setDebugInfo('Fout: ' . $e->getMessage());
                $this->feedback->setCode($e->getCode());
                $this->feedback->setCodeDriver('ModernWays DAL Connection');
                $this->feedback->end();
                $this->feedback->log();
            }
        }
        return (!is_null($this->pdo));
    }

    public function close()
    {
        // $this->log->clear();
        $this->feedback->startTimeInKey('close connection');
        if (is_null($this->pdo))
        {
            $this->feedback->setText("Verbinding met {$this->hostName} met {$this->databaseName} is reeds gesloten");
            $this->feedback->log();
        }
        else
        {
            $this->pdo = NULL;
            $this->feedback->setText("Verbinding met {$this->hostName} met {$this->databaseName} is gesloten");
            $this->feedback->end();
            $this->feedback->log();
        }
    }
}

