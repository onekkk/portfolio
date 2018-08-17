<?php
	header('Content-type: text/plain; charset= UTF-8');
        require_once('init.php');
        $dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');


        $user = "";
        $item_id = "";
        if(isset($_POST['user']) && isset($_POST['item_id'])){
                $user = htmlspecialchars($_POST['user'], ENT_QUOTES);
                $item_id = (int) htmlspecialchars($_POST['item_id'], ENT_QUOTES);
                $bookmark_is = htmlspecialchars($_POST['bookmark_is'], ENT_QUOTES);
                //var_dump($bookmark_is);
                echo $bookmark_is == "true";

                if($bookmark_is == "true"){
                        $sth = $dbh->prepare('INSERT INTO bookmark(user, item_id) VALUES(?, ?);');
                        $sth->execute(array($user, $item_id));
                }else{
                        $sth = $dbh->prepare('DELETE FROM bookmark WHERE user = ? && item_id = ? ; ');
                        $sth->execute(array($user, $item_id));

                }
        }




