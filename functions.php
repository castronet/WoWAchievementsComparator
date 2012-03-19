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

function dump_json($data, $parent = null)
{
//	print_r($data);
//	return;
	$r = 0;
	$i = 0;
	$parent_exists = false;

	if (isset($parent) && count($parent) > 0)
		$parent_exists = true;

	foreach ($data as $c)
	{
		$j = 0;
		if (isset($c['achievements']))
		{
			foreach ($c['achievements'] as $a)
			{

				$i++;
				$j++;
				if ($parent_exists)
					printf("\n%d - PareCategoria: %s | Categoria: %s %d-%s (%d): %s", $i, $parent['name'], $c['name'], $a['id'], $a['title'], $a['points'], $a['description']);
				else
					printf("\n%d - Categoria: %s %d-%s (%d): %s", $i, $c['name'], $a['id'], $a['title'], $a['points'], $a['description']);

				print_r($a);
			}
		}

		if (isset($c['categories']))
		{
			$r = dump_json($c['categories'], array("id" => $c['id'], "name" => $c['name']));
			$i += $r;

		}

		printf("\nCategoria %d %s resultados: %d\n\n\n", $c['id'], $c['name'], $r+$j);
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
