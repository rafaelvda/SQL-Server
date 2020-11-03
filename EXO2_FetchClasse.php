<?php
require ('EXO2_FormationEleve.php');
require ('EXO1_Repository_SQLServer.php');


class FetchRepository extends PDORepository{
		        public function init() {
		            $requeteSql = "select id_eleve, nom_eleve, nb_heures_cours_info, code_filiere from PROCS.FORMATIONELEVES";
								$statement = $this->queryList($requeteSql,PDO::FETCH_BOTH,NULL) ;
								while ($eleve = $statement->fetch())
								{
                                            print_r($eleve);
								}
		        }  // fin init
					}


class FetchClasseRepository extends PDORepository{
		        public function init() {
		            $requeteSql = "select id_eleve, nom_eleve, nb_heures_cours_info, code_filiere from PROCS.FORMATIONELEVES";
								$statement = $this->queryList($requeteSql,PDO::FETCH_CLASS,'FormationEleve') ;
								// bouclez sur le résultat pour afficher un élève à chaque itération: question 5.A.2
								while ($eleveClasse = $statement->fetch())
								{
										echo "L'éléve à les caratéristiques suivantes : $eleveClasse";
								}
		        }  // fin de la méthode init

				public function insert(FormationEleve  $eleve){
		        	$statement = $this->Insertion($eleve);
				}
					}

					// Affichage via un FETCH_BOTH
/*$userBoth = new FetchRepository()	;
$userBoth->init() ;
$userClasse = new FetchClasseRepository();
$userClasse->init();*/

$billien = new FormationEleve(1, "Billien", 35, "SLAM3");
$userClasse = new FetchRepository()	;
$userClasse->insert($billien);

?>

 