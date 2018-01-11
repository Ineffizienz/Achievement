<?php

	switch ($_REQUEST["page"]) {
		case 'overview':
			$content = build_content("overview.html");
		break;
		case 'create':
			$content = build_content("create_ac.html");
		break;
		case 'trigger':
			$content = build_content("create_trig.html");
		break;
		case 'categorie':
			$content = build_content("create_c.html");
		break;
		case 'changelog':
			$content = build_content("changelog.html");
		break;
		default: 
			$content = build_content("overview.html");
	}
?>