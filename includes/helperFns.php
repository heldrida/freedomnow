<?php


	function getTheDate($option) {
		
		$now = time();

		if ($option === 'greveFome') {

			$start_date = strtotime("2015-09-20");

		} else if ($option === 'diasPresos') {

			$start_date = strtotime("2015-06-20");

		}

		$datediff = $now - $start_date;
		
		return floor($datediff/(60*60*24));

	}