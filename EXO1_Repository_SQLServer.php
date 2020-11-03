<?php
abstract class PDORepository{
    const USERNAME="rafael_vda";
    const PASSWORD="rafael";
    const SERVER="SQLSRV2";
    const DB="rmico";

    private function getConnection(){
        $username = self::USERNAME;
        $password = self::PASSWORD;
        $server = self::SERVER;
        $db = self::DB;
        try {
            $connection = new PDO("sqlsrv:server=$server,1433;Database=$db", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Échec lors de la connexion : ' . $e->getMessage();
        }
        return $connection;
    }
    protected function queryList($sql, $fetch_mode,$nom_classe){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        if ($nom_classe === NULL && $fetch_mode != PDO::FETCH_COLUMN)
        {
            $stmt->setFetchMode($fetch_mode);
        }
        else if ($fetch_mode == PDO::FETCH_COLUMN) {
            $stmt->setFetchMode($fetch_mode,0);

        }
        else
        {
            $stmt->setFetchMode($fetch_mode|PDO::FETCH_PROPS_LATE,$nom_classe);
        }
        $stmt->execute();
        return $stmt;
    }

    protected function Insertion(FormationEleve $uneleve){
        $connection = $this->getConnection();
        $stmt = $connection->prepare("INSERT INTO PROCS.FORMATIONELEVES(nom_eleve, nb_heures_cours_info, code_filiere) VALUES(:nom, :nbh, :filiere)");

        $nom = $uneleve->getNom_eleve();
        $nbh = $uneleve->getNb_heures_cours_info();
        $filiere = $uneleve->getCode_filiere();

        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':nbh', $nbh, PDO::PARAM_INT);
        $stmt->bindParam(':filiere', $filiere, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt;
    }
}

?>
