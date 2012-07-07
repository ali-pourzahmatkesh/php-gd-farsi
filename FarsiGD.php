<?php

class FarsiGD {

    public function utf8_strlen($str) {
        return preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $dummy);
    }

    public $p_chars = array(
        'آ' => array('ﺂ', 'ﺂ', 'آ'),
        'ا' => array('ﺎ', 'ﺎ', 'ا'),
        'ب' => array('ﺐ', 'ﺒ', 'ﺑ'),
        'پ' => array('ﭗ', 'ﭙ', 'ﭘ'),
        'ت' => array('ﺖ', 'ﺘ', 'ﺗ'),
        'ث' => array('ﺚ', 'ﺜ', 'ﺛ'),
        'ج' => array('ﺞ', 'ﺠ', 'ﺟ'),
        'چ' => array('ﭻ', 'ﭽ', 'ﭼ'),
        'ح' => array('ﺢ', 'ﺤ', 'ﺣ'),
        'خ' => array('ﺦ', 'ﺨ', 'ﺧ'),
        'د' => array('ﺪ', 'ﺪ', 'ﺩ'),
        'ذ' => array('ﺬ', 'ﺬ', 'ﺫ'),
        'ر' => array('ﺮ', 'ﺮ', 'ﺭ'),
        'ز' => array('ﺰ', 'ﺰ', 'ﺯ'),
        'ژ' => array('ﮋ', 'ﮋ', 'ﮊ'),
        'س' => array('ﺲ', 'ﺴ', 'ﺳ'),
        'ش' => array('ﺶ', 'ﺸ', 'ﺷ'),
        'ص' => array('ﺺ', 'ﺼ', 'ﺻ'),
        'ض' => array('ﺾ', 'ﻀ', 'ﺿ'),
        'ط' => array('ﻂ', 'ﻄ', 'ﻃ'),
        'ظ' => array('ﻆ', 'ﻈ', 'ﻇ'),
        'ع' => array('ﻊ', 'ﻌ', 'ﻋ'),
        'غ' => array('ﻎ', 'ﻐ', 'ﻏ'),
        'ف' => array('ﻒ', 'ﻔ', 'ﻓ'),
        'ق' => array('ﻖ', 'ﻘ', 'ﻗ'),
        'ک' => array('ﻚ', 'ﻜ', 'ﻛ'),
        'گ' => array('ﮓ', 'ﮕ', 'ﮔ'),
        'ل' => array('ﻞ', 'ﻠ', 'ﻟ'),
        'م' => array('ﻢ', 'ﻤ', 'ﻣ'),
        'ن' => array('ﻦ', 'ﻨ', 'ﻧ'),
        'و' => array('ﻮ', 'ﻮ', 'ﻭ'),
        'ی' => array('ﯽ', 'ﯿ', 'ﯾ'),
        'ك' => array('ﻚ', 'ﻜ', 'ﻛ'),
        'ي' => array('ﻲ', 'ﻴ', 'ﻳ'),
        'أ' => array('ﺄ', 'ﺄ', 'ﺃ'),
        'ؤ' => array('ﺆ', 'ﺆ', 'ﺅ'),
        'إ' => array('ﺈ', 'ﺈ', 'ﺇ'),
        'ئ' => array('ﺊ', 'ﺌ', 'ﺋ'),
        'ة' => array('ﺔ', 'ﺘ', 'ﺗ')
    );
    public $tahoma = array(
        'ه' => array('ﮫ', 'ﮭ', 'ﮬ')
    );
    public $normal = array(
        'ه' => array('ﻪ', 'ﻬ', 'ﻫ')
    );
    public $mp_chars = array('آ', 'ا', 'د', 'ذ', 'ر', 'ز', 'ژ', 'و', 'أ', 'إ', 'ؤ');
    public $ignorelist = array('', 'ٌ', 'ٍ', 'ً', 'ُ', 'ِ', 'َ', 'ّ', 'ٓ', 'ٰ', 'ٔ', 'ﹶ', 'ﹺ', 'ﹸ', 'ﹼ', 'ﹾ', 'ﹴ', 'ﹰ', 'ﱞ', 'ﱟ', 'ﱠ', 'ﱡ', 'ﱢ', 'ﱣ',);
    public $openClose = array('>', ')', '}', ']', '<', '(', '{', '[');
    public $en_chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'); 
///
    public function persianText($str, $z="", $method='tahoma', $farsiNumber=true) {
        $en_str = '';
        $runWay = '';
        if ($method == 'tahoma') {
            $this->p_chars = array_merge($this->p_chars, $this->tahoma);
        } else {
            $this->p_chars = array_merge($this->p_chars, $this->normal);
        }
        $str_len = $this->utf8_strlen($str);
        preg_match_all("/./u", $str, $ar);
        for ($i = 0; $i < $str_len; $i++) {
            $gatherNumbers = false;
            $runWay = null;
            $str1 = $ar[0][$i];
            if (in_array($ar[0][$i + 1], $this->ignorelist)) {
                $str_next = $ar[0][$i + 2];
                if ($i == 2)
                    $str_back = $ar[0][$i - 2];
                if ($i != 2)
                    $str_back = $ar[0][$i - 1];
            }elseif (!in_array($ar[0][$i - 1], $this->ignorelist)) {
                $str_next = $ar[0][$i + 1];
                if ($i != 0)
                    $str_back = $ar[0][$i - 1];
            }else {
                if (isset($ar[0][$i + 1]) && !empty($ar[0][$i + 1])) {
                    $str_next = $ar[0][$i + 1];
                } else {
                    $str_next = $ar[0][$i - 1];
                }
                if ($i != 0)
                    $str_back = $ar[0][$i - 2];
            }
            if (!in_array($str1, $this->ignorelist)) {
                if (array_key_exists($str1, $this->p_chars)) {
                    if (!$str_back or $str_back == " " or !array_key_exists($str_back, $this->p_chars)) {
                        if (!array_key_exists($str_back, $this->p_chars) and !array_key_exists($str_next, $this->p_chars))
                            $output = $str1 . $output;
                        else
                            $output = $this->p_chars[$str1][2] . $output;
                        continue;
                    }elseif (array_key_exists($str_next, $this->p_chars) and array_key_exists($str_back, $this->p_chars)) {
                        if (in_array($str_back, $this->mp_chars) and array_key_exists($str_next, $this->p_chars)) {
                            $output = $this->p_chars[$str1][2] . $output;
                        } else {
                            $output = $this->p_chars[$str1][1] . $output;
                        }
                        continue;
                    } elseif (array_key_exists($str_back, $this->p_chars) and !array_key_exists($str_next, $this->p_chars)) {
                        if (in_array($str_back, $this->mp_chars)) {
                            // just font FREEFARSI work for H at end of sth that not connected like Dah!
                            $output =  $str1 . $output;
                        } else {
                            $output = $this->p_chars[$str1][0] . $output;
                        }
                        continue;
                    }
                } elseif ($z == "fa") {

                    $number = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩", "۴", "۵", "۶", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
                    switch ($str1) {
                        case ")" : $str1 = "(";
                            break;
                        case "(" : $str1 = ")";
                            break;
                        case "}" : $str1 = "{";
                            break;
                        case "{" : $str1 = "}";
                            break;
                        case "]" : $str1 = "[";
                            break;
                        case "[" : $str1 = "]";
                            break;
                        case ">" : $str1 = "<";
                            break;
                        case "<" : $str1 = ">";
                            break;
                    }
                    if (in_array($str1, $number)) {
                        if ( $farsiNumber ) {
                            $num .= $this->fa_number($str1);
                            $runWay[] = '1';
                        } else {
                            $num .= $str1;
                            $runWay[] = '2';
                        }
                        $str1 = "";
                    }
                    
                    if ( !in_array($str_next, $number) ) {
                        if ( in_array(strtolower($str1), $this->en_chars) or (($str1==' ' or $str1=='.') and $en_str!='' and !in_array($str_next, $this->p_chars)) ) {
                            $en_str .= $str1 . $num;
                            $str1 = '';
                            $runWay[] = '3';
                        } else {
                            if ( $en_str!='' ) {
                                if ( $i+1==$str_len ) {
                                    $runWay[] = '3.5';
                                    $str1 = $str1.$num;
                                } else {
                                    $en_str .= $str1 .$num;
                                    $runWay[] = '4';
                                }
                            } else {
                                $str1 = $str1.$num;
                                $runWay[] = '5';
                            }    
                           
                        }
                        $num = '';
                    }
                    if ( $en_str!='' or ($str1!='' and $i==0 and ( !array_key_exists($str_next, $this->p_chars) and $str_next!=' ' ))  or $gatherNumbers ) { //or ($str1!='' and $i==0)

                        if ( !array_key_exists($str1, $this->p_chars) ) {
                            if ( !array_key_exists($str_next, $this->p_chars) and $str_next!=' ' and !in_array($str_next, $this->openClose) ) { 
                                $en_str = $en_str.$str1;                               
                                $runWay[] = '6';
                            } else {
                                if ( in_array($ar[0][$i+2], $this->en_chars) ) {
                                   $en_str = $en_str.$str1;
                                   $runWay[] = '7';
                                } else {
                                    
                                    if ( $str_next==' ' and ( in_array($ar[0][$i+2], $number) or in_array(strtolower($ar[0][$i+2]), $this->en_chars) ) ) {
                                        $en_str = $en_str.$str1;
                                        $runWay[] = '8';
                                    } else {
                                        //if ( in_array($str_next, $this->openClose) and in_array(strtolower($str_back), $this->en_chars) ) {
                                        // $output = $output . $en_str;
                                        // $en_str = '';
                                         //   $en_str = $en_str.$str1;
                                         //   $i++;
                                        //    continue;
                                            //$output = $output . $en_str;
                                            //$en_str='';
                                         //   $runWay[] = '9.5';
                                       // } else {
                                            $output = $en_str . $output;
                                            $en_str = '';
                                            $runWay[] = '9';
                                       // }
                                    }
                                    
                                }
                            }
                            
                        } else {
                            if ( $num ) {
                                $en_str = $en_str .$num;
                                $runWay[] = '10';
                            } else {
                                $output = $en_str . $str1 . $output ;
                                $en_str = '';
                                $runWay[] = '11';
                            }
                        }
                        
                    } else {
                        
                        if ( in_array($str1, $number) and $str_next=='.' and in_array($ar[0][$i+2], $number) ) {
                            $en_str = $str1;
                            $runWay[] = '12';
                        } else {
                            //if ( in_array($str1, $this->openClose) and in_array($str_next, $this->en_chars) ) {
                            //    $output = $str1.$output ;
                            //    $runWay[] = '13';
                           //} else {
                                $output = $str1. $output ;
                                $runWay[] = '14';
                           // }
                        }
                    }    
                } else {
                    if (($str1 == "،") or ($str1 == "؟") or ($str1 == "ء") or (array_key_exists($str_next, $this->p_chars) and array_key_exists($str_back, $this->p_chars)) or
                            ($str1 == " " and array_key_exists($str_back, $this->p_chars)) or ($str1 == " " and array_key_exists($str_next, $this->p_chars))) {
                        if ($e_output) {
                            $output = $e_output . $output;
                            $e_output = "";
                        }
                        $output = $str1 . $output;
                    } else {
                        $e_output.=$str1;
                        if (array_key_exists($str_next, $this->p_chars) or $str_next == "") {
                            $output = $e_output . $output;
                            $e_output = "";
                        }
                    }
                }
            } else {
                $output = $str1 . $output;
            }
            
            //fb("str1: {$str1} | num: {$num} | output: {$output} | enSter: {$en_str} | strNex: {$str_next} | strBack: {$str_back}| path: ". implode('-',$runWay) );
            
            $str_next = null;
            $str_back = null;
        }

        if ( $en_str!='' ) {
            $output = $en_str . $output ;
        }
        return $output;
    }

    public function fa_number($num) {
        $AF = array(
            0 => "٠",
            1 => "١",
            2 => "٢",
            3 => "٣",
            4 => "۴",
            5 => "۵",
            6 => "۶",
            7 => "٧",
            8 => "٨",
            9 => "٩"
        );

        $af_date = NULL;
        $chars = preg_split('//', $num, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($chars as $key => $val) {
            $af_num = NULL;
            switch ($val) {
                case "0";
                    $af_num = $AF[0];
                    break;
                case "1":
                    $af_num = $AF[1];
                    break;
                case "2":
                    $af_num = $AF[2];
                    break;
                case "3":
                    $af_num = $AF[3];
                    break;
                case "4":
                    $af_num = $AF[4];
                    break;
                case "5":
                    $af_num = $AF[5];
                    break;
                case "6":
                    $af_num = $AF[6];
                    break;
                case "7":
                    $af_num = $AF[7];
                    break;
                case "8":
                    $af_num = $AF[8];
                    break;
                case "9":
                    $af_num = $AF[9];
                    break;
                default :
                    $af_num = $val;
            }
            $af_date .=$af_num;
        }
        return $af_date;
    }

}

?>