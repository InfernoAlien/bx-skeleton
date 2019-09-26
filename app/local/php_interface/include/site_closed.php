<?php

$errorPage = $_SERVER['DOCUMENT_ROOT'].'/error_50x/index.html';

echo file_get_contents($errorPage);