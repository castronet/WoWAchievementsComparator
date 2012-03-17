<?php
define("WAC_SITE", "eu.battle.net");
define("WAC_SRC_URL", "/api/wow/data/character/achievements");
define("WAC_REALM", "C'Thun");
define("WAC_FACTION", "horde");


function get_achievements_data()
{
	$fetch_url = sprintf("http://%s%s", WAC_SITE, WAC_SRC_URL);

	$json_source = "";
	$array_data = array();
	$array_data = @file($fetch_url);
	if ($array_data === false)
		exit_error(2);

	$json_source = implode($array_data);
	$array_data = json_decode($json_source, true);
	if (json_last_error() > 0)
		exit_json_error(json_last_error());

	//return $array_data;
	return $array_data['achievements'];
}

function dump_json($data)
{
//	print_r($data);
//	return;
	$i = 0;
	foreach ($data as $c)
	{
		if (isset($c['achievements']))
			foreach ($c['achievements'] as $a)
			{

				$i++;
				printf("\n- Categoria: %s %d-%s (%d): %s", $c['name'], $a['id'], $a['title'], $a['points'], $a['description']);
				print_r($a);
			}

		if (isset($c['categories']))
			$i += dump_json($c['categories']); 
	}

	return $i;
}

function create_wac_database($data)
{
	return false;
}

function exit_error($code)
{
	switch ($code)
	{
		case 1:
			$text = "Timestamp file not found";
			break;
		case 2:
			$text = "Achievements data unreachable";
			break;
		default:
			$text = "";
	}
	printf("ERROR: (%d) %s\n", $code, $text);

	exit($code);
}

function exit_json_error($text)
{
	printf("ERROR: (json_decode) %s\n", $text);

	exit(3);
}

?>
