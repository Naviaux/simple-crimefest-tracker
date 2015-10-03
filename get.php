<?php
	if (isset($_GET['site']))
		echo file_get_contents($_GET['site']);
	else
		echo file_get_contents("http://api.steampowered.com/ISteamUserStats/GetGlobalStatsForGame/v0001/?appid=218620&count=4&name[0]=crimefest_challenge_chains_3&name[1]=crimefest_challenge_clover_3&name[2]=crimefest_challenge_dallas_3&name[3]=crimefest_challenge_houston_3");
?>