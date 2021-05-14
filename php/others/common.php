<?php

    function sanitize ($before) {
        foreach ($before as $key => $value) {
            $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        return $after;
    }

    function str_sanitize ($before) {
        $after = htmlspecialchars($before, ENT_QUOTES, 'UTF-8');
        return $after;
    }

    function h ($i) {
        $after = htmlspecialchars($i, ENT_QUOTES, 'UTF-8');
        return $after;
    }

    function h_arr ($i) {
        foreach ($i as $key => $value) {
            $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }

    // function date_filter($i) {
    //     $i = filter_var($i, FILTER_SANITIZE_NUMBER_INT);
    //     $i = str_replace('-', '', $i);
    //     return $i;
    // }

    // function trim_year($i) {
    //     $year = (int) substr($i, 0, -10);
    //     return $year;
    // }
    // function trim_month($i) {
    //     $month = (int) substr($i, 4, -8);
    //     return $month;
    // }
    // function trim_day($i) {
    //     $day = (int) substr($i, 6, -6);
    //     return $day;
    // }

    function trim_date ($i) {
        $i = filter_var($i, FILTER_SANITIZE_NUMBER_INT);
        $i = str_replace('-', '', $i);
        $year = (int) substr($i, 0, -10);
        $month = (int) substr($i, 4, -8);
        $day = (int) substr($i, 6, -6);
        $array = array('year' => $year);
        $array += array('month' => $month);
        $array += array('day' => $day);
        return $array;
    }

    function divide_hyphen ($i) {
        //$iは2021-05-08 01:29:32などの文字列
        
        $str = trim_date($i);
        $str = implode('/', $str);
        return$str;
    }

    function pref_list () {
        $pref_list = array(
            '1'=>'北海道',
            '2'=>'青森県',
            '3'=>'岩手県',
            '4'=>'宮城県',
            '5'=>'秋田県',
            '6'=>'山形県',
            '7'=>'福島県',
            '8'=>'茨城県',
            '9'=>'栃木県',
            '10'=>'群馬県',
            '11'=>'埼玉県',
            '12'=>'千葉県',
            '13'=>'東京都',
            '14'=>'神奈川県',
            '15'=>'新潟県',
            '16'=>'富山県',
            '17'=>'石川県',
            '18'=>'福井県',
            '19'=>'山梨県',
            '20'=>'長野県',
            '21'=>'岐阜県',
            '22'=>'静岡県',
            '23'=>'愛知県',
            '24'=>'三重県',
            '25'=>'滋賀県',
            '26'=>'京都府',
            '27'=>'大阪府',
            '28'=>'兵庫県',
            '29'=>'奈良県',
            '30'=>'和歌山県',
            '31'=>'鳥取県',
            '32'=>'島根県',
            '33'=>'岡山県',
            '34'=>'広島県',
            '35'=>'山口県',
            '36'=>'徳島県',
            '37'=>'香川県',
            '38'=>'愛媛県',
            '39'=>'高知県',
            '40'=>'福岡県',
            '41'=>'佐賀県',
            '42'=>'長崎県',
            '43'=>'熊本県',
            '44'=>'大分県',
            '45'=>'宮崎県',
            '46'=>'鹿児島県',
            '47'=>'沖縄県'
        );
        return $pref_list;
    }

    // function assign_str ($i) {
    //     $str = '';
    //     foreach ($i as $value) {
    //         $str .= "<p>$value</p>";
    //     }
    //     return $str;
    // }

    function assign_option ($i, $j) {
        foreach ($i as $key => $value) {
            if ($j !== '' && $key === (int)$j) {
                echo "<option value=\"$key\" selected>$value</option><br>";
            } else {
                echo "<option value=\"$key\">$value</option><br>";
            }
        }
    }


    function check_str ($str, $key) {
        if (isset($str[$key])) {
            $checked_str = $str[$key];
        } else {
            $checked_str = '';
        }
        return $checked_str;
    }

    // ファイルアップロードにおける拡張子の判定
    function get_upload_file_name ($tofile, $path) {

        //ファイル情報を取得する
        $info = pathinfo($tofile);
        //拡張子(extension)情報を格納する
        $ext = strtolower($info['extension']);
    
        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png') {
            $err_msg = '<p>拡張子はjpg、jpeg、またはpngのいずれかを指定してください。</p>';
        }
        $count = 0;
        do {
            //'%08x'は16進数(x)の乱数(mt_rand)が8文字分
            //mt_rand関数を用いて、ユニークなファイル名にする
            $tofile = "%s/" . date('Ymd_') . "%08x.%s";
            $file = sprintf($tofile, $path, mt_rand(), $ext);
            
            //fopenはファイルを開くときに同名のファイルが存在している場合にはfalseを返すため
            $fp = fopen($file, 'x');
        } while ($fp === false && ++$count < 10);

        if ($fp === false) {
            $err_msg = '<p>ファイルが作成できません。</p>';
        }

        fclose($fp);
        $exp_arr['filename'] = $file;
        
        if (isset($err_msg)) {
            $exp_arr['err_msg'] = $err_msg;
        }
        return $exp_arr;
    }


    const UPLOADPATH = "../../img/";
    const UPLOADPATH_ITEM = "../img/";

?>