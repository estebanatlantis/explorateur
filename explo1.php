<?php
$d = dir (".");
echo "Pointeur: ".$d->handle."<br>/n";
echo "chemin: ".$s->path."<br>/n";
while($entry = $d->read()) {
    echo $entry."<br>/n";
}
$d->close();
?>