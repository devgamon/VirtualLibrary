<?php header("Access-Control-Allow-Origin: *");
      include('./biblioteca.php');
    
$cd = isset($_GET['cd']) ? $_GET['cd'] : 0;

$todos = ListarLivro($cd);

$a = array();
while($p = $todos->fetch_object()){
    $a[] = $p;
}

$a = json_encode($a);
echo $a;

?>
 