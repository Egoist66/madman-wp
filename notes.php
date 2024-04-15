<?php

/* 

    Template Name: Notes
    Template Post Type: page


*/

if($_SERVER['REQUEST_METHOD'] === 'GET'){
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