<?php
require_once(dirname(__FILE__).'/vendor/autoload.php');

header('Content-type: text/html; charset=utf-8');

define('DOCUMENT_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']));
define('FOLDER_ROOT', str_replace(DOCUMENT_ROOT, '', str_replace('\\', '/', dirname(__FILE__))));
$allowedExtensions=array('md', 'markdown');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="content-type" http-equiv="content-type" value="text/html; utf-8"/>
        
        <link rel="stylesheet" type="text/css" href="<?php print FOLDER_ROOT; ?>/css/normalize.css"/>
        <link rel="stylesheet" type="text/css" href="<?php print FOLDER_ROOT; ?>/css/utilities.css"/>
        <link rel="stylesheet" type="text/css" href="<?php print FOLDER_ROOT; ?>/css/typography.css"/>
        <link rel="stylesheet" type="text/css" href="<?php print FOLDER_ROOT; ?>/css/layout.css"/>
        <link rel="stylesheet" type="text/css" href="<?php print FOLDER_ROOT; ?>/css/small.css"/>
    </head>
    <body>
        <div class="wrapper">
            <?php
            $file=str_replace('\\', '/', realpath($_SERVER['PATH_TRANSLATED']));
            if($file && is_file($file) && in_array(strtolower(substr($file, strrpos($file, '.')+1)), $allowedExtensions) && substr($file, 0, strlen(DOCUMENT_ROOT))==DOCUMENT_ROOT) {
                $parser=new ParsedownExtra();
                print $parser->Parse(file_get_contents($file));
            }else {
                print '<p>Bad filename given</p>';
            }
            ?>
        </div>
        
        <script type="text/javascript" src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
        <script type="text/javascript" src="<?php print FOLDER_ROOT; ?>/thirdparty/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php print FOLDER_ROOT; ?>/javascript/main.js"></script>
    </body>
</html>