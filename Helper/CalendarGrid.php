<?php

/**
 *  Based on Max's Calendar, adapted for Asset Booking Project needs
 */
namespace Xerias\AssetBookingBundle\Helper;

class CalendarGrid{

    protected $eventsByDate;
    protected $firstDay;
    protected $lastDay;
    protected $startMonth;
    protected $startYear;

    public function CalendarGrid(){
        $this->eventsByDate = array();
    }

    public function add($day, $month, $year, $data){

    }

    public function getFirstDay(){
        return $this->firstDay;
    }
    public function getLastDay(){
           return $this->lastDay;
    }

    public function init($startYear=0, $startMonth=0, $numberOfMonths=6){

        $this->startMonth = $startMonth;
        $this->startYear = $startYear;
        $this->numberOfMonths = $numberOfMonths;


    }


    public function isAvailable($day){

        return !array_key_exists($day, $this->eventsByDate);
    }

    public function renderCalendarMonth($year, $month){


       $referenceDay = getdate(mktime(0,0,0,$month,1,$year));

       $firstDay = getdate(mktime(0,0,0,$referenceDay['mon'],1,$referenceDay['year']));
       $lastDay  = getdate(mktime(0,0,0,$referenceDay['mon']+1,0,$referenceDay['year']));

       $today    = getdate();

       $out = '';

	// Create a table with the necessary header informations
	$out .= '<table class="calendar-month">';
	$out .= '  <tr><th colspan="7">'.$referenceDay['month']." - ".$referenceDay['year']."</th></tr>";
	$out .= '  <tr class="days"><td>Mo</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td><td>Sa</td><td>Su</td></tr>';
	
	
	// Display the first calendar row with correct positioning
	$out .= '<tr>';
	if ($firstDay['wday'] == 0) $firstDay['wday'] = 7;
	for($i=1;$i<$firstDay['wday'];$i++){
		$out .= '<td>&nbsp;</td>';
	}
	$actday = 0;

    for($i=$firstDay['wday'];$i<=7;$i++){

		$actday++;
        $isAvailable = $this->isAvailable($actday);
    	if (($actday == $today['mday']) && ($today['mon'] == $month)) {
			$class = ' class="actday"';
		} else {
			$class = ' class="i"';
            $dayHtml = '&nbsp;';
		}
		$out .= '<td' .  $class. '>' . $actday . '</td>';
	}
	$out .= '</tr>';
	
	//Get how many complete weeks are in the actual month
	$fullWeeks = floor(($lastDay['mday']-$actday)/7);
	
	for ($i=0;$i<$fullWeeks;$i++){

        $out .= '<tr>';
		for ($j=0;$j<7;$j++){
			$actday++;

    		if (($actday == $today['mday']) && ($today['mon'] == $month)) {
				$class = ' class="actday"';
            }else {
                $class = ' class="i"';
            }
		    $out .= '<td' .  $class. '>' . $actday . '</td>';
		}
		$out .= '</tr>';
	}
	
	//Now display the rest of the month
	if ($actday < $lastDay['mday']){
		$out .= '<tr>';
		
		for ($i=0; $i<7;$i++){

			$actday++;

      		if (($actday == $today['mday']) && ($today['mon'] == $month)) {
				$class = ' class="actday"';
			} else {
                $class = ' class="i"';
                $dayHtml = '&nbsp;';
            }
			
			if ($actday <= $lastDay['mday']){
				$out .= '<td ' . $class . '>' . $actday . '</td>';
			}
			else {
				$out .= '<td>&nbsp;</td>';
			}
		}
		
		
		$out .= '</tr>';
	}
	
	$out .= '</table>';
        return $out;
}
    public function renderGrid(){

        $out = '';
        $currentMonth = $this->startMonth;
        $currentYear = $this->startYear;

        $cols = 3;

        $out .= '<table class="calendar-grid">';
        $out .= '<tr>';
        for($i = 0; $i< $this->numberOfMonths; $i++){

            if($i > 0 && $i % $cols == 0){
                $out .= '</tr><tr>';
            }

            $out .= '<td>' . $this->renderCalendarMonth($currentYear,$currentMonth) . '</td>';

            $currentMonth++;
            if($currentMonth > 12){
                $currentMonth = 1; $currentYear++;
            }
        }
        $out .= '</tr>';
        $out .= '</table>';
        return $out;   
    }
}
?>