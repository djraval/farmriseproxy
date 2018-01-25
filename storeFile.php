<?php
    $myfile = fopen("./file.txt", "w") or die("Unable to open file!");
    $txt = microtime();
    fwrite($myfile, $txt);
    fclose($myfile);
?>