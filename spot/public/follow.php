<?php
	header('Content-type: text/plain; charset= UTF-8');
	require_once('init.php');
        $dbh = new PDO('mysql:host=localhost;dbname=spot', 'root', 'ichimura');
	

	$follow = "";
	$follower = "";
	if(isset($_POST['follow']) && isset($_POST['follower'])){
		$follow = htmlspecialchars($_POST['follow'], ENT_QUOTES);
		$follower = htmlspecialchars($_POST['follower'], ENT_QUOTES);
		$follow_is = htmlspecialchars($_POST['follow_is'], ENT_QUOTES);
		var_dump($follow_is);
		echo $follow_is == "true";

		if($follow_is == "true"){
			$sth = $dbh->prepare('INSERT INTO follow(follow, follower) VALUES(?, ?);');
                        $sth->execute(array($follow, $follower));
		}else{
			$sth = $dbh->prepare('DELETE FROM follow WHERE follow = ? && follower = ? ; ');
                        $sth->execute(array($follow, $follower));
                        echo "OK";

		}
	}


