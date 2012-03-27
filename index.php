<?php
# vi:si:et:sw=4:sts=4:ts=4
include("functions.php");

$time_init = $_SERVER['REQUEST_TIME'];


// this function should be templatizated as jaquery
function create_item_span($i)
{
?>
    <li class="last">
        <!--<a href="achievement#81:a6059" class="clear-after"> -->
            <span class="float-right">
                <span class="date">01/12/2011</span>
            </span>
            <span class="icon">
            <span class="icon-frame frame-18 " style="background-image: url(&quot;http://eu.media.blizzard.com/wow/icons/18/<?php echo $i[''] ?>&quot;);">
                </span>
            </span>
            <span class="info">
            <strong class="title"><?php echo $i['title'] ?></strong>
            <span class="description"><?php echo $i['description'] ?>:</span>
            </span>
        <!-- </a> -->
    </li>
<?php
}

?>
<html>
    <head>
        <title>Achievements Comparator</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="Author" content="^Hex^"/>
        <meta name="Generator" content="Vim"/>
        <link rel="stylesheet" type="text/css" media="all" href="http://eu.battle.net/wow/static/local-common/css/common.css" />
        <link rel="stylesheet" type="text/css" media="all" href="http://eu.battle.net/wow/static/css/wow.css" />
        <link rel="stylesheet" type="text/css" media="all" href="http://eu.battle.net/wow/static/css/profile.css" />
        <link rel="stylesheet" type="text/css" media="all" href="http://eu.battle.net/wow/static/css/character/achievement.css" />
<?php /*<link rel="shortcut icon" href="/dibs/uec-ico.png" type="image/gif"/>*/ ?>
    </head>

    <body>
<?php
printf("<pre>");




$time_start = microtime(true);
    $a = dump_json(get_achievements_data());
	echo "\ncount: ".count($i)."\n";

$time_clean = microtime(true);
    $a = clean_dups($a);
	echo "\ncount2: ".count($a)."\n";
$time_end = microtime(true);

    	print_r($a[0]);

printf("</pre>");
printf("<ul>");
foreach ($a as $achievement)
{
    create_item_span($achievement);
}
printf("</ul>");
?>

<br />
    Temps total: <?= time() - $time_init; ?>s<br />
    Temps càlcul: <?= $time_end - $time_start ?>s<br />
    Temps càlcul duplicats: <?= $time_end - $time_clean ?>s<br />
    </body>
</html>
