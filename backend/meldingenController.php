<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie))
{
    $errors[] = "Vul de attractie-naam in.";
}

$type = $_POST['type'];
if(empty($type))
{
    $errors[] = "Kies wat voor type.";
}

$capaciteit = $_POST['capaciteit'];
if(empty($capaciteit))
{
    $errors[] = "Vul voor capaciteit een geldig getal in.";
}

if(isset($_POST['prioriteit']))
{
    $prioriteit = true;
}
else
{
    $prioriteit = false;
}
$melder = $_POST['melder'];
if(empty($melder))
{
    $errors[] = "Vul je naam AUB";
}
$overig = $_POST['overig'];



// echo $attractie . " / " . $capaciteit . " / " . $melder;

//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie,  type,  capaciteit, prioriteit, melder, overige_info)
VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";
//3. Prepare
$stmt = $conn->prepare($query);
//4. Execute
$stmt->execute([
    ":attractie" => $attractie,
    ":type" => $type,
    ":capaciteit" => $capaciteit,
    ":prioriteit" => $prioriteit,
    ":melder" => $melder,
    ":overige_info" => $overig,
]);


$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Location:../meldingen/index.php?msg=melding opgeslagen");
