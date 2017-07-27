<?php
ini_set("display_errors",0);
include("controllers/c_lien_he.php");
$c_lien_he=new C_lien_he();
$lien_he=$c_lien_he->Lien_he();
?>