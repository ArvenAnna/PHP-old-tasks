<?php
class Range
{
	public $from;
	public $to;
	private $day_from;
	private $month_from;
	private $year_from;
	private $year_to;
	private $month_to;
	private $day_to;
	
	function __construct($from,$to)
	{
		$this->from=$from;
		$this->to=$to;
	}
	
	function get_validation_logs()
	{
		$valid_logs;
		$pattern_date="/^\d{2}-\d{2}-\d{4}$/i";
		if(!preg_match($pattern_date,$this->from) or !preg_match($pattern_date,$this->to))
		{
			$valid_logs[0]=1;
		}
		else
		{
			$from=explode("-", $this->from);
			$to=explode("-", $this->to);
			$this->day_from=$from[0];
			$this->month_from=$from[1];
			$this->year_from=$from[2];
			$this->day_to=$to[0];
			$this->month_to=$to[1];
			$this->year_to=$to[2];
			settype($this->day_from, 'integer');
			settype($this->day_to, 'integer');
			settype($this->month_from, 'integer');
			settype($this->month_to, 'integer');
			settype($this->year_from, 'integer');
			settype($this->year_to, 'integer');
			if($this->year_from<1970 or $this->year_to<1970 or $this->year_from>2038 or $this->year_to>2038)
			{
				$valid_logs[1]=1;
			}

			else
			{
				if($this->month_from<=12 and $this->month_to<=12 and $this->month_from>0 and $this->month_to>0)
				{
					switch($this->month_from)
					{
						case 2: 
							if(leap_year($this->year_from)==true)
							{
								if($this->day_from>29 or $this->day_from==0)
								{
									$valid_logs[2]=1;
								}
							}
							else
							{
								if($this->day_from>28 or $this->day_from==0)
								{
									$valid_logs[2]=1;
								}
							}
							break;
						case 4:
							if($this->day_from>30 or $this->day_from==0)
							{
								$valid_logs[2]=1;
							}
							break;
						case 6:
							if($this->day_from>30 or $this->day_from==0)
							{
								$valid_logs[2]=1;
							}
							break;
						case 9:
							if($this->day_from>30 or $this->day_from==0)
							{
								$valid_logs[2]=1;
							}
							break;
						case 11:
							if($this->day_from>30 or $this->day_from==0)
							{
								$valid_logs[2]=1;
							}
							break;
						default:
							if($this->day_from>31 or $this->day_from==0)
							{
								$valid_logs[2]=1;
							}
					}
					
					
					switch($this->month_to)
					{
						case 2: 
							if(leap_year($this->year_to)==true)
							{
								if($this->day_to>29 or $this->day_to==0)
								{
									$valid_logs[2]=1;
								}
							}
							else
							{
								if($this->day_to>28 or $this->day_to==0)
								{
									$valid_logs[2]=1;
								}
							}
							break;
						case 4:
							if($this->day_to>30 or $this->day_to==0)
							{
								$valid_logs[2]=1;
							
							}
							break;
						case 6:
							if($this->day_to>30 or $this->day_to==0)
							{
								$valid_logs[2]=1;
							}
							break;
						case 9:
							if($this->day_to>30 or $this->day_to==0)
							{
								$valid_logs[2]=1;
							}
							break;
						case 11:
							if($this->day_to>30 or $this->day_to==0)
							{
								$valid_logs[2]=1;
							}
							break;
						
							
						default:
							if($this->day_to>31 or $this->day_to==0)
							{
								$valid_logs[2]=1;
							}
					}
					
				}
				else
				{
					$valid_logs[2]=1;	
				}
			}

		}
		if(empty($valid_logs))
		{
			$timestamp_from = strtotime($this->from);
			$timestamp_to = strtotime($this->to); 
			if($timestamp_from>$timestamp_to)
			{
				$valid_logs[3]=1;
			}
		}
		warnings($valid_logs);
		if(empty($valid_logs))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function create_list($day_of_week)
	{
		$list;
		$j=0;
		$timestamp_from = strtotime($this->from);
		$timestamp_to = strtotime($this->to); 
		$week_from = date("w",$timestamp_from);
		
		for($i=strtotime($this->from);$i<=strtotime($this->to);$i=$i+3600*24)
		{
			if(date("w",$i)==$day_of_week)
			{
				$list[$j]=date("d-m-Y", $i);
				$list[$j]=$list[$j]."-$i ";
				$j++;
			}
		}
		return $list;
	}
}

function warnings($valid_logs)
{
	echo "<div class='warning'>";
	if($valid_logs[0]==1)
	{
		echo "Ошибка: придерживайтесь требуемого формата";
	}
	if($valid_logs[1]==1)
	{
		echo "Ошибка: в одном из полей указан слишком ранний год или год из далекого будущего, вводите года с 1970 по 2038.";
	}
	if($valid_logs[2]==1)
	{
		echo "Ошибка: в одном из полей указана несуществующая дата";
	}
	if($valid_logs[3]==1)
	{
		echo "Ошибка: дата начала диапазона больше даты его конца - поменяйте местами даты";
	}
	echo "</div>";
}

function leap_year($year)
{
	$leap=false;
	if($year%4==0)
	{
		$leap=true;
	}
	if($year%100==0)
	{
		$leap=false;
	}
	if($year%400==0)
	{
		$leap=true;
	}
	return $leap;
}
?>