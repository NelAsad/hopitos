<?php

//librairies
require 'public/librairies/fpdf1/fpdf.php';
require 'public/librairies/dompdf/autoload.inc.php';

//libs main files
require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/database.php';
require 'libs/Session.php';
require 'libs/Model.php';
require 'libs/view.php';

//Config
require 'config/paths.php';
require 'config/database.php';

// Le routeur
$app = new Bootstrap();