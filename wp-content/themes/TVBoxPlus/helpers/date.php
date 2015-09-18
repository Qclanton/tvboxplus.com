<?php 
class Date {
	public function format($date_utc) {
		$date = array();
		$time = array();
		
		list($date['full'], $time['full']) = explode("T", $date_utc);
		list($date['year'], $date['month'], $date['day']) = explode("-", $date['full']);
		list($time['hour'], $time['minute'], $time['second']) = explode(":", $time['full']);
		
		$russian_months = $this->getRussianMonths();
		$date['month'] = $russian_months[$date['month']];
		
		$formatted_date = (int)$date['day'] . " " . $date['month'] . ", " . $time['hour'] .  ":" . $time['minute'];
		
		return $formatted_date;
	}
	
	private function getRussianMonths() {
		$months = array(
			'01'=>"января",
			'02'=>"февраля",
			'03'=>"марта",
			'04'=>"апреля",
			'05'=>"мая",
			'06'=>"июня",
			'07'=>"июля",
			'08'=>"августа",
			'09'=>"сентября",
			'10'=>"октября",
			'11'=>"ноября",
			'12'=>"декабря",
		);
		
		return $months;
	}
}

