<?php 

// connections 
$db  = new SQLite3('main.db');
$db->exec("CREATE TABLE link(id INTEGER PRIMARY KEY, link TEXT, encrypt TEXT)");

// random string
function generateRandomString() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// create short link
function short_link($link) {
    
    if($link == get_link("link", $link)[1]);

    else { 

        $rand = generateRandomString();
        global $db;
        $stmt = $db->prepare("INSERT INTO link(link, encrypt) VALUES(:link, :encrypt)");
        $stmt->bindValue(':link', $link);
        $stmt->bindValue(':encrypt', $rand);
        $stmt->execute();
        
    }

}

// get link
function get_link($key, $value) { 
    global $db; 
    $stmt = $db->prepare("SELECT * FROM link WHERE $key = :enc");
     $stmt->bindValue(":enc", $value);
     $result = $stmt->execute();     
     return $result->fetchArray();
   
    

}


