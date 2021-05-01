<?php

    function sanitize($before) {
        foreach ($before as $key => $value) {
            $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        return $after;
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


?>