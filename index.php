<?php 

include "db.php"; 
$req = $_SERVER['REQUEST_URI'];

// index page 
if($req == "/") { 
    include "Link.php";
}

else if($req == "/get") { 
    
        if(empty($_REQUEST['url'])) { 

            echo json_encode(['status' => 'required']);
        }else {
        // validate url 
        if(filter_var($_REQUEST['url'],FILTER_VALIDATE_URL)){ 
        
            // get and add short link
            short_link($_REQUEST['url']);
             $link = get_link('link', $_POST['url'])[2];
             echo json_encode(['data' => $link]);

        }
        else { 
            
            echo json_encode(['status' => 'url data']);
        }
    }
}


else { 
    // splite string and get data
    $get_link = explode("/", $req);
    $link = get_link('encrypt',$get_link[1])[1];
    
    if($link) { 
        header("Location: $link");

    } else { 
        
       header("HTTP/1.0 404 Not Found");
        echo "<h1>PAGE NOT FOUNT </h1>";
    }
}
