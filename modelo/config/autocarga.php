<?php
spl_autoload_register(function ($clase) {

    include "../modelo/clases/$clase.php";
});