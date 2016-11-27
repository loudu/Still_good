
<?php

$app->get('/produits',function ($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM produits ORDER by id");
    $sth->execute();
    $produits = $sth->fetchAll();
    return $this -> response -> withJson($produits);
});


$app->get('/magasins',function ($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM magasin ORDER by id");
    $sth->execute();
    $magasins = $sth->fetchAll();
    return $this -> response -> withJson($magasins);
});


//voir un produit en particulier

$app->get('/produit/[{id}]',function ($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM produits WHERE id=:id");
    $sth->bindParam("id",$args ['id']);
    $sth->execute();
    $produit = $sth->fetchObject();
    return $this->response->withJson($produit);

});
//surprimé un produit
$app-> delete ( '/produit/[{id}]', function ($request, $response, $args){
    $sth = $this->db->prepare ("DELETE FROM produits WHERE id=:id");
    $sth->bindParam ("id", $args ['id']);
    $sth->execute();
    return ;

});











// ajouté un produit
$app-> post ('/produit',function ($request, $response) {
    $input =$request->getParsedBody ();
    $sql = "INSERT INTO produits(id,nom,date_peremption,id_magasin,date_depot,asso_recup_id) VALUES (:id,:nom,:date_peremption,:id_magasin,:date_depot,:asso_recup_id)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("id",$input['id']);
    $sth->bindParam("nom",$input['nom']);
    $sth->bindParam("date_peremption",$input['date_peremption']);
    $sth->bindParam("id_magasin",$input['id_magasin']);
    $sth->bindParam("date_depot",$input['date_depot']);
    $sth->bindParam("asso_recup_id",$input['asso_recup_id']);
    $sth->execute ();
    $input ['id'] = $this->db->lastInsertId();
    return $this->response -> withJson ($input);
});

//recupere un produit par supermarché

$app->get('/produit/supermarches/[{id}]',function ($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM produits WHERE id_magasin=:id");
    $sth->bindParam("id",$args ['id']);
    $sth->execute();
    $magasin = $sth->fetchALL();
    return $this->response->withJson($magasin);

});
