<?php

/* 

    Template Name: Notes
    Template Post Type: page


*/

echo "Сегодня " . date("Y/m/d") . "<br>";
$myfile = fopen(__DIR__ . '/notes.txt', "r") or die("Не удается открыть файл!");
echo fread($myfile, filesize(__DIR__ . '/notes.txt'));

fclose($myfile);

echo ceil(disk_free_space(dirname(__DIR__)) / 1024 / 1024 / 1024) . " ГБ свободного места";

$name = "<h2>My name is farid</h2>";
//filter_input(INPUT_GET, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
echo filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

highlight_string('<?php echo "Hello"; ?>');

//highlight_file(__FILE__);

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    // if($_GET['drop'] === 'true'){
    //     trigger_error('Error', E_USER_ERROR);
    // };


    $action = $_GET['action'] ?? '';
    $file = $_GET['file'] ?? '';
    $drop = $_GET['drop'] ?? '';

    if($drop === 'true'){
        unlink(__DIR__ . '/' . $file);
    }

    if($action === 'view'){
        $copy = copy(__DIR__ . '/' . $file, __DIR__ . '/notes.txt');
        $content = file_get_contents(__DIR__ . '/' . '/notes.txt');
        $data = htmlspecialchars("$content");
        echo "<pre style='height: 30vh;'>
        
            $data
        
        </pre>";
        
    }
}



?>

<?php get_header(); ?>



<?php the_content(); ?>

<?php 
    $files = scandir(get_template_directory());
    for ( $i = 1; $i < count($files); $i++ ){
        $file = __DIR__ .'/'. $files[$i];

        
       
        if(is_file($file)){
            echo "<div><a href='?action=view&file=$files[$i]'>$files[$i]</a></div>";
        }
    }

?>


<?php get_footer(); ?>