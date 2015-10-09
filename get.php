<?php
	$steamapi = "http://api.steampowered.com/ISteamUserStats/GetGlobalStatsForGame/v0001/?appid=218620&count=8&name[0]=crimefest_challenge_houston_3&name[1]=crimefest_challenge_chains_5&name[2]=crimefest_challenge_clover_5&name[3]=crimefest_challenge_dallas_5&name[4]=crimefest_challenge_houston_5&name[5]=crimefest_challenge_chains_6&name[6]=crimefest_challenge_clover_6&name[7]=crimefest_challenge_dallas_6";
	if (isset($_GET['site'])) {
		$cache = @file_get_contents('./'.md5($_GET['site']).'_requestcache.tmp');
		if ($cache) {
			$data = unserialize($cache);
			if ((time() - strtotime($data['time'])) > 60) {
				// Cache is expired
				$res = doRequest($_GET['site']);
				echo $res ?: $data['data'];
			} else {
				echo $data['data'];
			}
		} else {
			echo doRequest($_GET['site']);
		}
	} else {
		$cache = @file_get_contents('./'.md5($steamapi).'_requestcache.tmp');
		if ($cache) {
			$data = unserialize($cache);
			
			if ((time() - strtotime($data['time'])) > 15) {
				// Cache is expired
				$res = doRequest($steamapi);
				echo $res ?: $data['data'];
			} else {
				echo $data['data'];
			}
		} else {
			echo doRequest($steamapi);
		}
	}

	function doRequest($site) {
		$fh = @fopen('./'.md5($site).'_requestcache.tmp', 'w');
		if (flock($fh, LOCK_EX)) {
			$response = file_get_contents($site);

			$data = array(
				'data' => $response,
				'time' => date('c')
			);

			fwrite($fh, serialize($data));
			flock($fh, LOCK_UN);
			return $response;
		}

		return false;
	}
?>
