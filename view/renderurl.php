<?php
// Check if the REQUEST_URI is set
if(isset($_SERVER['REQUEST_URI'])) {
   
    $current_url = $_SERVER['REQUEST_URI'];
    $new_url = str_replace('.php', '.com', $current_url);

    if($new_url!= $current_url) {
        header("Location: $new_url");
    }
    
} else {
    echo "Unable to retrieve current URL.";
}
?>
