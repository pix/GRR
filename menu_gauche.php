<?php

if ($_GET['pview'] != 1)
{
	$path = $_SERVER['PHP_SELF'];
	$file = basename ($path);
	if ( $file== 'month_all2.php' or Settings::get("menu_gauche") == 0){
		echo '<div id="menuGaucheMonthAll2">';
	} elseif ( Settings::get("menu_gauche") == 2){
		echo '<div class="col-lg-12 col-md-12 col-xs-12">';
	} else{
		echo '<div class="col-lg-3 col-md-12 col-xs-12">';
	}
	echo '<div id="menuGauche">';

	$pageActuel = str_replace(".php","",basename($_SERVER['PHP_SELF']));

	// Calendrier
	minicals($year, $month, $day, $area, $room, $pageActuel);
	
	// Liste sites, domaines, ressources
	if (isset($_SESSION['default_list_type']) || (Settings::get("authentification_obli") == 1))
		$area_list_format = $_SESSION['default_list_type'];
	else
		$area_list_format = Settings::get("area_list_format");

	if(Settings::get("menu_gauche") == 2){
		echo "\n<div class=\"col-lg-3 col-md-12 col-xs-12\">\n".PHP_EOL;
	} else{
		echo "\n<div class=\"col-lg-12 col-md-12 col-xs-12\">\n".PHP_EOL;
	}

	if ($area_list_format != "list")
	{
		if ($area_list_format == "select")
		{
			echo make_site_select_html('week_all.php', $id_site, $year, $month, $day, getUserName());
			echo make_area_select_html('week_all.php', $id_site, $area, $year, $month, $day, getUserName());
			echo make_room_select_html('week', $area, $room, $year, $month, $day);
		}
		else
		{
			echo make_site_item_html('week_all.php', $id_site, $year, $month, $day, getUserName());
			echo make_area_item_html('week_all.php',$id_site, $area, $year, $month, $day, getUserName());
			echo make_room_item_html('week', $area, $room, $year, $month, $day);
		}
	}
	else
	{

		echo make_site_list_html('week_all.php',$id_site,$year,$month,$day,getUserName());
		echo make_area_list_html('week_all.php',$id_site, $area, $year, $month, $day, getUserName());
		echo make_room_list_html('week.php', $area, $room, $year, $month, $day);
		

	}

	echo "\n</div>\n".PHP_EOL;

	//Legende
	if (Settings::get("legend") == '0'){
		if(Settings::get("menu_gauche") == 2){
			echo "\n<div class=\"col-lg-3 col-md-12 col-xs-12\">\n".PHP_EOL;
		} else{
			echo "\n<div class=\"col-lg-12 col-md-12 col-xs-12\">\n".PHP_EOL;
		}
		show_colour_key($area);
		echo "\n</div>\n".PHP_EOL;
	}

	//
	echo '</div>';
	echo '</div>';

}
?>