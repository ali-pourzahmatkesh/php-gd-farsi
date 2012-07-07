<?php
function utf8_strlen($str) {
	return preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $dummy);
}
$p_chars = array (
	'آ' => array ('ﺂ', 'ﺂ', 'آ'),
	'ا' => array ('ﺎ', 'ﺎ', 'ا'),
	'ب' => array ('ﺐ', 'ﺒ', 'ﺑ'),
	'پ' => array ('ﭗ', 'ﭙ', 'ﭘ'),
	'ت' => array ('ﺖ', 'ﺘ', 'ﺗ'),
	'ث' => array ('ﺚ', 'ﺜ', 'ﺛ'),
	'ج' => array ('ﺞ', 'ﺠ', 'ﺟ'),
	'چ' => array ('ﭻ', 'ﭽ', 'ﭼ'),
	'ح' => array ('ﺢ', 'ﺤ', 'ﺣ'),
	'خ' => array ('ﺦ', 'ﺨ', 'ﺧ'),
	'د' => array ('ﺪ', 'ﺪ', 'ﺩ'),
	'ذ' => array ('ﺬ', 'ﺬ', 'ﺫ'),
	'ر' => array ('ﺮ', 'ﺮ', 'ﺭ'),
	'ز' => array ('ﺰ', 'ﺰ', 'ﺯ'),
	'ژ' => array ('ﮋ', 'ﮋ', 'ﮊ'),
	'س' => array ('ﺲ', 'ﺴ', 'ﺳ'),
	'ش' => array ('ﺶ', 'ﺸ', 'ﺷ'),
	'ص' => array ('ﺺ', 'ﺼ', 'ﺻ'),
	'ض' => array ('ﺾ', 'ﻀ', 'ﺿ'),
	'ط' => array ('ﻂ', 'ﻄ', 'ﻃ'),
	'ظ' => array ('ﻆ', 'ﻈ', 'ﻇ'),
	'ع' => array ('ﻊ', 'ﻌ', 'ﻋ'),
	'غ' => array ('ﻎ', 'ﻐ', 'ﻏ'),
	'ف' => array ('ﻒ', 'ﻔ', 'ﻓ'),
	'ق' => array ('ﻖ', 'ﻘ', 'ﻗ'),
	'ک' => array ('ﻚ', 'ﻜ', 'ﻛ'),
	'گ' => array ('ﮓ', 'ﮕ', 'ﮔ'),
	'ل' => array ('ﻞ', 'ﻠ', 'ﻟ'),
	'م' => array ('ﻢ', 'ﻤ', 'ﻣ'),
	'ن' => array ('ﻦ', 'ﻨ', 'ﻧ'),
	'و' => array ('ﻮ', 'ﻮ', 'ﻭ'),
	'ی' => array ('ﯽ', 'ﯿ', 'ﯾ'),
	'ك' => array ('ﻚ', 'ﻜ', 'ﻛ'),
	'ي' => array ('ﻲ', 'ﻴ', 'ﻳ'),
	'أ' => array ('ﺄ', 'ﺄ', 'ﺃ'),
	'ؤ' => array ('ﺆ', 'ﺆ', 'ﺅ'),
	'إ' => array ('ﺈ', 'ﺈ', 'ﺇ'),
	'ئ' => array ('ﺊ', 'ﺌ', 'ﺋ'),
	'ة' => array ('ﺔ', 'ﺘ', 'ﺗ')
);
$nastaligh = array(
	'ه' => array ('ﮫ', 'ﮭ', 'ﮬ')
);
$normal    = array(
	'ه' => array ('ﻪ', 'ﻬ', 'ﻫ')
);
$mp_chars = array ('آ', 'ا', 'د', 'ذ', 'ر', 'ز', 'ژ', 'و', 'أ', 'إ', 'ؤ');
$ignorelist = array('','ٌ','ٍ','ً','ُ','ِ','َ','ّ','ٓ','ٰ','ٔ','ﹶ','ﹺ','ﹸ','ﹼ','ﹾ','ﹴ','ﹰ','ﱞ','ﱟ','ﱠ','ﱡ','ﱢ','ﱣ',);
///
function fagd($str,$z="",$method='normal'){
	global $p_chars,$mp_chars, $ignorelist,$nastaligh,$normal;
	if($method == 'nastaligh'){
		$p_chars = array_merge($p_chars,$nastaligh);
	}elsE{
		$p_chars = array_merge($p_chars,$normal);
	}
	$str_len=utf8_strlen($str);
	preg_match_all("/./u", $str, $ar);
	for ($i=0; $i<$str_len; $i++){
		$str1=$ar[0][$i];
		if(in_array($ar[0][$i+1],$ignorelist)){
			$str_next=$ar[0][$i+2];
			if ($i == 2) $str_back=$ar[0][$i-2];
			if ($i != 2) $str_back=$ar[0][$i-1];
		}elseif(!in_array($ar[0][$i-1],$ignorelist)){
			$str_next=$ar[0][$i+1];
			if ($i != 0) $str_back=$ar[0][$i-1];

		}else{
			if(isset($ar[0][$i+1]) && !empty($ar[0][$i+1])){
				$str_next=$ar[0][$i+1];
			}else{
				$str_next=$ar[0][$i-1];
			}
			if ($i != 0) $str_back=$ar[0][$i-2];
		}
		if(!in_array($str1,$ignorelist)){
			if (array_key_exists($str1,$p_chars)){
				if(!$str_back or $str_back==" " or !array_key_exists($str_back,$p_chars)){
					if(!array_key_exists($str_back,$p_chars) and !array_key_exists($str_next,$p_chars)) $output=$str1.$output;
					else $output=$p_chars[$str1][2].$output;
					continue;
				}elseif (array_key_exists($str_next,$p_chars) and array_key_exists($str_back,$p_chars)){
					if(in_array($str_back,$mp_chars) and array_key_exists($str_next,$p_chars)){
						$output=$p_chars[$str1][2].$output;
					}else{
						$output=$p_chars[$str1][1].$output;
					}
					continue;
				}elseif(array_key_exists($str_back,$p_chars) and !array_key_exists($str_next,$p_chars)){
					if(in_array($str_back,$mp_chars)){
						$output=$str1.$output;
					}else{
						$output=$p_chars[$str1][0].$output;
					}
					continue;
				}

			}elseif($z=="fa"){

				$number =array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩","۴","۵","۶","0","1","2","3","4","5","6","7","8","9");
				switch ($str1){
					case ")" : $str1="("; break;
					case "(" : $str1=")"; break;
					case "}" : $str1="{"; break;
					case "{" : $str1="}"; break;
					case "]" : $str1="["; break;
					case "[" : $str1="]"; break;
					case ">" : $str1="<"; break;
					case "<" : $str1=">"; break;
				}
				if(in_array($str1,$number)){
					$num.=$str1;
					$str1="";
				}
				if (!in_array($str_next,$number)){
					$str1.=$num;
					$num="";
				}
				$output=$str1.$output;
			}else{
				if(($str1=="،") or ($str1=="؟") or ($str1=="ء") or (array_key_exists($str_next,$p_chars) and array_key_exists($str_back,$p_chars)) or
				($str1==" " and array_key_exists($str_back,$p_chars)) or ($str1==" " and array_key_exists($str_next,$p_chars)))
				{
					if($e_output){
						$output=$e_output.$output;
						$e_output="";
					}
					$output=$str1.$output;
				}
				else{
					$e_output.=$str1;
					if(array_key_exists($str_next,$p_chars) or $str_next==""){
						$output=$e_output.$output;
						$e_output="";
					}
				}
			}
		}else{
			$output=$str1.$output;
		}
		$str_next = null;
		$str_back = null;
	}
	return  $output;
}
?>