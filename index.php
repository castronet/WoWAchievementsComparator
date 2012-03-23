<?php
# vi:si:et:sw=4:sts=4:ts=4
include("functions.php");
?>
<html>
    <head>
        <title>Achievements Comparator</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="Author" content="^Hex^"/>
        <meta name="Generator" content="Vim"/>
<?php /*<link rel="shortcut icon" href="/dibs/uec-ico.png" type="image/gif"/>*/ ?>
    </head>

    <body>
Before
<br />
<pre>
<?php
    $i = 0;
    $i = dump_json(get_achievements_data());
	echo "\ncount: ".count($i)."\n";

    $i = clean_dups($i);
	echo "\ncount2: ".count($i)."\n";
//    	print_r($i);
?>
</pre>

<br />
after
    </body>
</html>
