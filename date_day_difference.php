<?php
class date_day_difference
{
	/**
	 *@author mraiur <mraiur@nikolai-ivanov.com, mraiur@gmail.com>
	 *@link http://mraiur.com/code/category29/date_day_difference/
	 */
	private $current_day;
	private $current_year_day;
	private $destination_day;
	private $destination_year_day;
	private $total_day_diffrence;
	private $pos_neg_diffrence = false;
	
	/**
	 *@param string $paramDestinationDay string convertable by strtotime() function for the endpoint date
	 *@param string $paramCurrent string convertable by strtotime() function for the current date if not provided takes the current date
	 */
	public function __construct($paramDestinationDay, $paramCurrent = null)
	{
		$this->current_day = ( $paramCurrent!=null )?$paramCurrent:time();
		$this->current_year_day = date("z", $this->current_day);
		$this->destination_day = strtotime($paramDestinationDay);
		$this->destination_year_day = date("z", $this->destination_day);
	}
	
	private function day_diffrence()
	{
		$day_dif = abs($this->current_year_day - $this->destination_year_day);
		if( $this->destination_year_day > $this->current_year_day )
		{// comming
			$this->pos_neg_diffrence = true;
		}
		else
		{//past
			$this->pos_neg_diffrence = false;
		}
		$this->total_day_diffrence = $day_dif;
	}
	
	private function year_diffrence()
	{
		$year_dif = date("Y",$this->current_day) - date("Y", $this->destination_day);
		if( $year_dif > 0 )
		{// passed
			$this->total_day_diffrence += ( 365 * abs($year_dif) );
			$this->pos_neg_diffrence = false;
		}
		elseif( $year_dif < 0 )
		{// comming
			$this->total_day_diffrence += ( 365 * abs($year_dif) );
			$this->pos_neg_diffrence = true;
		}
	}
	
	/**
	 *@return array 0 => (true for upcomming and false for passed), 1 => ( day diffrence )
	 */
	public function init()
	{
		$this->day_diffrence();
		$this->year_diffrence();
		return array( 0 => $this->pos_neg_diffrence, 1 => $this->total_day_diffrence );
	}
}
?>