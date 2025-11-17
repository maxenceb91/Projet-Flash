<?php
function connectToDbAndGetPdo()
{
    return new PDO("mysql:host=localhost;dbname=game_base", "root", "root");
}
?>