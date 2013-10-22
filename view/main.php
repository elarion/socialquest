<?php

    include_once('./templates/head.php');

    if (file_exists($path) && is_file($path)) {
        include_once($path);
    }

    include_once('./templates/footer.php');