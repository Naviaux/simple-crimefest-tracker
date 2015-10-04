<?php
	if (isset($_GET['site'])) {
		if (file_exists('requestcache.tmp')) {
			$data = unserialize(file_get_contents('requestcache.tmp'));

			if ((time() - strtotime($data['last_request']) > 60) {
				// Cache is expired
				echo doRequest($_GET['site']);
			}

			echo $data['data'];
		} else {
			echo doRequest($_GET['site']);
		}
	} else {
		echo file_get_contents("http://api.steampowered.com/ISteamUserStats/GetGlobalStatsForGame/v0001/?appid=218620&count=6&name[0]=crimefest_challenge_chains_3&name[1]=crimefest_challenge_clover_3&name[2]=crimefest_challenge_houston_3&name[3]=crimefest_challenge_chains_4&name[4]=crimefest_challenge_clover_4&name[5]=crimefest_challenge_houston_4");
	}

	function doRequest($site) {
		$response = file_get_contents($site);

		$data = array(
			'data' => $response,
			'time' => date('c')
		);

		file_put_contents('requestcache.tmp', serialize($data));
		return $response;
	}
?>
