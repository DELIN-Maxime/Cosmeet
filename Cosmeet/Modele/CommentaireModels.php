<?php
class CommentaireModels
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance();     
    }

    public function addCommentaire($commentaire, $id_publication)
    {
        $query = "SELECT MAX(id_commentaire) FROM commentaires";
        $stmt = $this->pdo->getPdo()->prepare($query);
        $stmt->execute();
        $lastId = $stmt->fetchColumn();
        $newId = $lastId + 1;

        $auteur = $_SESSION['utilisateur']['pseudo'];

        $S_table = "commentaires";
        $A_parametres = [
            "id_commentaire" => $newId,
            "commentaire" => "$commentaire",
            "id_publication" => "$id_publication",
            "auteur" => "$auteur",
            "date_commentaire" => date('y-d-m H:i:s')
        ];
        return $this->pdo->insert($S_table, $A_parametres);
    }
}