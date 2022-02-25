<?php

/**
 * 1. Commencez par importer le script SQL disponible dans le dossier SQL.
 * 2. Connectez-vous à la base de données blog.
 */

try {
    $server = 'localhost';
    $db = 'exo_202';
    $user = 'root';
    $pswd = '';

    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pswd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
/**
 * 3. Sans utiliser les alias, effectuez une jointure de type INNER JOIN de manière à récupérer :
 *   - Les articles :
 *     * id
 *     * titre
 *     * contenu
 *     * le nom de la catégorie ( pas l'id, le nom en provenance de la table Categorie ).
 *
 * A l'aide d'une boucle, affichez chaque ligne du tableau de résultat.
 */

// TODO Votre code ici.
    $stm = $bdd->prepare ("
        SELECT article.id, article.title, article.content
        FROM article
        INNER JOIN categorie ON article.category_fk = categorie.id
    ");

    if($stm->execute()) {
        foreach ($stm->fetchAll() as $item) {
            echo "<pre>" . print_r($item) . "</pre>";
        }
    }

    /**
     * 4. Réalisez la même chose que le point 3 en utilisant un maximum d'alias.
     */

// TODO Votre code ici.
    $stm = $bdd->prepare ("
        SELECT ar.id, ar.title, ar.content
        FROM article as ar
        INNER JOIN categorie ON ar.category_fk = categorie.id
    ");

    if($stm->execute()) {
        foreach ($stm->fetchAll() as $item) {
            echo "<pre>" . print_r($item) . "</pre>";
        }
    }

    /**
     * 5. Ajoutez un utilisateur dans la table utilisateur.
     *    Ajoutez des commentaires et liez un utilisateur au commentaire.
     *    Avec un LEFT JOIN, affichez tous les commentaires et liez le nom et le prénom de l'utilisateur ayant écrit le commentaire.
     */

// TODO Votre code ici.
    $stm = $bdd->prepare ("
        SELECT commentaire.content, utilisateur.lastName, utilisateur.firstName,
        FROM commentaire
        LEFT JOIN utilisateur on commentaire.user_fk = utilisateur.id
    ");
    if($stm->execute()) {
        foreach ($stm->fetchAll() as $item) {
            echo "<pre>" . print_r($item) . "</pre>";
        }
    }
}
catch (PDOException $e) {
    echo $e->getMessage();
}