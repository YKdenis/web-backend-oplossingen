<?php

/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28-12-2015
 * Time: 18:38
 */
class artikel_model
{
    private $titel;
    private $artikel;
    private $kernwoorden;
    private $datum;

    private $db;
    private $feedback;

    /**
     * @return mixed
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * @param mixed $titel
     */
    public function setTitel($titel)
    {
        $this->titel = $titel;
    }

    /**
     * @return mixed
     */
    public function getArtikel()
    {
        return $this->artikel;
    }

    /**
     * @param mixed $artikel
     */
    public function setArtikel($artikel)
    {
        $this->artikel = $artikel;
    }

    /**
     * @return mixed
     */
    public function getKernwoorden()
    {
        return $this->kernwoorden;
    }

    /**
     * @param mixed $kernwoorden
     */
    public function setKernwoorden($kernwoorden)
    {
        $this->kernwoorden = $kernwoorden;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

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
        $query = 'insert into artikels (titel, artikel, kernwoorden, datum) values (:titel, :artikel, :kernwoorden, NOW())';
        try {
            $preparedStatement = $this->db->prepare($query);
            // so we cannot use bindParam that requires a variable by value
            // if you want to use a variable, use then bindParam
            $preparedStatement->bindValue(':titel', $this->getTitel(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':artikel', $this->getArtikel(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':kernwoorden', $this->getKernwoorden(), \PDO::PARAM_STR);
            $result = $preparedStatement->execute();
            // als execute is uitgevoerd dan staat $result op true.
            if ($result) {
                $this->feedback->setText("Het artikel met titel {$this->getTitel()} is toegevoegd.");

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