<?php
	if ($_GET['site'] == "steam")
		echo file_get_contents("http://api.steampowered.com/ISteamUserStats/GetGlobalStatsForGame/v0001/?appid=218620&count=5&name[0]=crimefest_challenge_chains_1&name[1]=crimefest_challenge_dallas_1&name[2]=crimefest_challenge_clover_1&name[3]=crimefest_challenge_clover_2&name[4]=crimefest_challenge_houston_2");
	elseif ($_GET['site'] == "twitter")
		echo file_get_contents("http://trehe.com/followers/petegold_.json");
?>