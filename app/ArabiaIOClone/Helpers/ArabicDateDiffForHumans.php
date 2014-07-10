<?php

/**
 * Description of ArabicDateDiffForHumans
 *
 * @author Hichem MHAMED
 */
namespace ArabiaIOClone\Helpers;

class ArabicDateDiffForHumans
{
     private static $years = array(
"سنة" ,
"سنتين" ,
"سنوات"
);
     
     private static  $months = array(
"شهر"  ,
"شهران" ,
"أشهر" 
);
 
private static  $weeks = array(
"أسبوع" ,
"أسبوعان" ,
"أسابيع"
);
 
private static  $days = array(
"يوم",
"يومان" ,
"أيام"
);
 
private static  $hours = array(
"ساعة ",
"ساعتان ",
"ساعات "
);
 
private static  $minutes = array(
"دقيقة ",
"دقيقتان ",
"دقائق "
);
 
private static  $seconds = array(
   "ثانية" ,
"ثانيتان" ,
"ثواني"
);


	private static  function getArabicUnitArray($unit)
	{
	   if (strpos($unit, 'second') !== FALSE) return ArabicDateDiffForHumans::$seconds;
	   if (strpos($unit, 'minut') !== FALSE) return ArabicDateDiffForHumans::$minutes;
	   if (strpos($unit, 'hour') !== FALSE) return ArabicDateDiffForHumans::$hours;
	   if (strpos($unit, 'day') !== FALSE) return ArabicDateDiffForHumans::$days;
	   if (strpos($unit, 'week') !== FALSE) return ArabicDateDiffForHumans::$weeks;
           if (strpos($unit, 'month') !== FALSE) return ArabicDateDiffForHumans::$months;
	   if (strpos($unit, 'year') !== FALSE) return ArabicDateDiffForHumans::$years;
	}
	
	private static function getIndexFromDiff($diff)
	{
	   if ($diff <= 1 ) return 0;
	   if ($diff == 2) return 1;
	   if ($diff >= 3 &&  $diff <= 9 ) return 2;
	   if ($diff >= 10 ) return 0;
	}
 
	private static function getFilteredDiff($diff)
	{
	   if ($diff <= 1 ) return "";
	   if ($diff == 2) return "";
	   if ($diff >= 3 ) return $diff;
	}
 
 
public static function translateFromEnglish($dateLiteral)
{
   $segments = explode(' ', $dateLiteral);
   $diff =  $segments[0];
   $unit = $segments[1];
   
   $result = " قبل ".ArabicDateDiffForHumans::getFilteredDiff($diff)." ".ArabicDateDiffForHumans::getArabicUnitArray($unit)[ArabicDateDiffForHumans::getIndexFromDiff($diff)];
   return $result;
}

}

?>
