<?php
require_once(dirname(__FILE__).'/vendor/autoload.php');

header('Content-type: text/html; charset=utf-8');

define('DOCUMENT_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']));
define('FOLDER_ROOT', str_replace(DOCUMENT_ROOT, '', str_replace('\\', '/', dirname(__FILE__))));
$allowedExtensions=array('md', 'markdown');
$isError=false;

$file=str_replace('\\', '/', realpath($_SERVER['PATH_TRANSLATED']));
if($file && is_file($file) && in_array(strtolower(substr($file, strrpos($file, '.')+1)), $allowedExtensions) && substr($file, 0, strlen(DOCUMENT_ROOT))==DOCUMENT_ROOT) {
    $parser=new ParsedownExtra();
    $markdown=file_get_contents($file);
    
    $metaTitle=array();
    if(stripos($markdown, 'title:')==0 && preg_match('/title:\s*(.*)/i', $markdown, $metaTitle)) {
        $markdown=preg_replace('/title:\s*(.*)/i', '', $markdown, 1);
        $metaTitle=$metaTitle[1];
    }
    
    $output=$parser->Parse($markdown);
}else {
    $isError=true;
    
    $output='<p>Bad filename given</p>';
}
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
        <title><?php
            if(!$isError) {
                $titleMatches=array();
                if(is_string($metaTitle)) {
                    print  htmlspecialchars($metaTitle, ENT_QUOTES, 'UTF-8');
                }else if(stripos($output, '<h1>')==0 && preg_match('/<h1>(.*)<\/h1>/i', $output, $titleMatches)) {
                    print array_pop($titleMatches);
                }else {
                    $name=basename($file);
                    $name=preg_replace('/^[0-9]*[_-]+/', '', $name);
                    if(strrpos($name, '.')!==false) {
                        $name=substr($name, 0, strrpos($name, '.'));
                    }

                    $name=str_replace(array('-', '_'), ' ', $name);

                    print ucfirst(trim($name));
                }
            }else {
                print 'Error';
            }
        ?></title>
    </head>
    <body>
        <div class="wrapper">
            <?php
            print $output;
            ?>
        </div>
        
        <script type="text/javascript" src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
        <script type="text/javascript" src="<?php print FOLDER_ROOT; ?>/thirdparty/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php print FOLDER_ROOT; ?>/javascript/main.js"></script>
    </body>
</html>