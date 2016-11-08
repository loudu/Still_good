//faire le code de la base de donné et le code dependencies

//chagé les nom de base de donné
<?php
$app->get('/produits',function ($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM tasks ORDER by task");
    $sth->execute();
    $todos = $sth->fetchAll();
    return $this -> response -> withJson($todos);
});


//voir un produit en particulier

$app->get('/produit/[{id}]',function ($request, $response, $args){
    $sth = $this->db->prepare("SELECT * FROM tasks WHERE id=:id");
    $sth->bindParam("id",$args ['id']);
    $sth->execute();
    $todos = $sth->fetchObject();
    return $this->response->withJson($todos);

});


$app-> delete ( '/produit/[{id}]', function ($request, $response, $args){
    $sth = $this->db->prepare ("DELETE FROM tasks WHERE id=:id");
    $sth->bindParam ("id", $args ['id']);
    $sth->execute();
    return ;

});

$app-> post ('/produit',function ($request, $response) {
    $input =$request->getParsedBody ();
    $sql = "INSERT INTO tasks (task) VALUES (:task)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("task",$input['task']);
    $sth->execute ();
    $input ['id'] = $this->db->lastInsertId();
    return $this->response -> withJson ($input);
});