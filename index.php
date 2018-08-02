<?php
echo'<!DOCTYPE html>';
echo'<html lang="da">';
echo'<head>';

	# Include the meta/headers
	require_once('resources/meta.php');

echo'</head>';
echo'<body>';

    # Print errors
    if($singleton->getErrors()) {
        echo '<div class="errorContainer">';
            echo $singleton->getError();
            echo '<button class="closeError right">&#10006;</button>';
        echo '</div>';
    }

    # This will load the appropriate view
    require_once('views/'.$singleton::$page.'.php');

    # Load page specific JS document
    if (is_file('js/'.$singleton::$page.'.js'))
        echo '<script src="js/'.$singleton::$page.'.js"></script>';

echo'</body>';
echo'</html>';
?>
