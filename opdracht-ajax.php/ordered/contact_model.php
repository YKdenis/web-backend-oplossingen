<?php
class ContactModel
{
    private $email;
    private $message;
    private $time_sent;

    private $db;
    private $feedback;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getTimeSent()
    {
        return $this->time_sent;
    }

    /**
     * @param mixed $time_sent
     */
    public function setTimeSent($time_sent)
    {
        $this->time_sent = $time_sent;
    }

    public function __construct(\PDO $db, \Amen\Dialog\Model\Feedback $feedback)
    {
       $this->db = $db;
        $this->feedback = $feedback;
    }

    public function __destruct()
    {
        $this->db = null;
    }

    public function create()
    {
       // we gaan ervan uit dat het mislukt
        $result = false;
        $query = 'insert into mail_service (email, message, time_sent) values (:email, :message, NOW())';
        try {
            $preparedStatement = $this->db->prepare($query);
            // so we cannot use bindParam that requires a variable by value
            // if you want to use a variable, use then bindParam
            $preparedStatement->bindValue(':email', $this->getEmail(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':message', $this->getMessage(), \PDO::PARAM_STR);
            $result = $preparedStatement->execute();
            // als execute is uitgevoerd dan staat $result op true.
            if ($result) {
                $this->feedback->setText("Het bericht van {$this->getEmail()} is toegevoegd.");

            } else {
                // $preparedStatement->errorinfo() is een methode van sql dat standaard
                // in php zit. Het is een array dat info bevat over mogelijke errors.
                // indien er geen errors zijn is de array leeg en zal er dus ook niets in
                // feedback komen te staan.
                $sQLErrorInfo = $preparedStatement->errorInfo();
                $this->feedback->setCode($sQLErrorInfo[0]);
                $this->feedback->setCodeDriver($sQLErrorInfo[1]);
                $this->feedback->setText($sQLErrorInfo[2]);
            }
            $this->feedback->setContext('Info van MySQL');

        } catch (\PDOException $e) {
            $this->feedback->setText($e->getMessage());
            $this->feedback->setContext('Fout gemeld door PDO in PHP');
        }
        $this->feedback->log();
        return $result;
    }
}
