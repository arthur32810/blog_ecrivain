<?php

require 'Controler.php';

	if(isset($_GET['action'])){
		if($_GET['action'] == 'allChapter'){
			$chapters = Chapter::allChapter();
			require '../view/ChaptersView.php';
		}
		elseif()
	}