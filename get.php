<?php
	$steamapi = "http://api.steampowered.com/ISteamUserStats/GetGlobalStatsForGame/v0001/?appid=218620&count=8&name[0]=crimefest_challenge_houston_3&name[1]=crimefest_challenge_chains_5&name[2]=crimefest_challenge_clover_5&name[3]=crimefest_challenge_dallas_5&name[4]=crimefest_challenge_houston_5&name[5]=crimefest_challenge_chains_6&name[6]=crimefest_challenge_clover_6&name[7]=crimefest_challenge_dallas_6";
	if (isset($_GET['site'])) {
		if (file_exists('./'.md5($_GET['site']).'_requestcache.tmp')) {
			$data = unserialize(file_get_contents('./'.md5($_GET['site']).'_requestcache.tmp'));

			if ((time() - strtotime($data['time'])) > 60) {
				// Cache is expired
				echo doRequest($_GET['site']);
			} else {
				echo $data['data'];
			}
		} else {
			echo doRequest($_GET['site']);
		}
	} else {
		if (file_exists('./'.md5($steamapi).'_requestcache.tmp')) {
			$data = unserialize(file_get_contents('./'.md5($steamapi).'_requestcache.tmp'));
			
			if ((time() - strtotime($data['time'])) > 15) {
				echo doRequest($steamapi);
			} else {
				echo $data['data'];
			}
		} else {
			echo doRequest($steamapi);
		}
	}

	function doRequest($site) {
		$response = file_get_contents($site);

		$data = array(
			'data' => $response,
			'time' => date('c')
		);

		file_put_contents('./'.md5($site).'_requestcache.tmp', serialize($data));
		return $response;
	}
?>
