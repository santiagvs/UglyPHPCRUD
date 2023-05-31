<?php

$pdo = new PDO("mysql:host={$config['dbhost']};dbname={$config['dbname']};charset=utf8", "{$config['dbuser']}", "{$config['dbpass']}");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['delete'])) {
  $id = (int) $_GET['delete'];
  $pdo->exec("DELETE FROM clientes WHERE id=$id");
  echo "Deletado com sucesso o id".$id;
}


// INSERT
if(isset($_POST['nome'])) {
  $sql = $pdo->prepare("INSERT INTO clientes VALUES (null, ?, ?)");
  $sql->execute(array($_POST['nome'], $_POST['email']));
  echo 'Inserido com sucesso' . PHP_EOL;
}

?><form method="post">
  <input type="text" name="nome">
  <input type="text" name="email">
  <input type="submit" value="Enviar">
</form>
<?php

$sql = $pdo->prepare("SELECT * FROM clientes");
$sql->execute();

$fetchClientes = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($fetchClientes as $key => $value) {
  echo '<a href="?delete='.$value['id'].'">(X)</a> '.$value['nome'] . ' | ' . $value['email'];
  echo '<hr>';
}

?>
