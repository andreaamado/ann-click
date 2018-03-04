<?php
function pagination($param, $array) {
    $num_page = 50;
    if ($array != 0) {
        $pagination = array();
        $pages = array_chunk($array, $num_page);
        $actual_page = intval($param['ann_page']);
        $open_page = (($actual_page * $num_page) - $num_page);

        for ($h = 1; $h < count($pages) + 1; $h++) :
            if ($h == $actual_page) {
                $pagination[$h]['ann_print'] = "[ $h ] ";
            } else {
                $pagination[$h]['ann_print'] = "[ <a href=\"admin.php?page=" . $param['url'] . "&ann_type=" . $param['type'] .  "&ann_page=$h\">$h</a> ] ";
            }
        endfor;

        $pagination[0]['ann_actual'] = $open_page;
        $pagination[0]['ann_qty'] = $num_page;
        return $pagination;
    }
}

?>