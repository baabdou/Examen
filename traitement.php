<?php

try{

  require('connexionBD.php');
  // requette d'insertion dans la base de donnée
  $requete=$con->prepare("INSERT INTO formulaire(NOM,PRENOM,ADRESSE)
                          VALUES(:nom,:prenom,:adresse)"
                          );

  // Minimum de "sécurité" avant de traiter les données du formulaire
 function securisation($info){
                $info = trim($info);
                $info = stripslashes($info);
                $info = strip_tags($info);
                return $info;
          }


          $nom = securisation($_POST['nom']);
          $prenom = securisation($_POST['prenom']);
          $adresse = securisation($_POST['adresse']);

  $requete->bindParam(':nom',$nom);
  $requete->bindParam(':prenom',$prenom);
  $requete->bindParam(':adresse',$adresse);

  $resultat = $requete->execute();

  if($resultat){
     header('Location: affichage.php');
  }else{
     header('Location: erreur.php');

  }

         
}catch(PDOException $e){
  echo 'Erreur!!! '.$e->getMessage();
  echo 'Echec de la connexion avec la base de donnée';
}
?>
