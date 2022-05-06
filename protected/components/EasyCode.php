<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */



/**

 * Description of EasyCode

 *

 * @author Rajib

 */
setlocale(LC_ALL, 'en_US.UTF8');

class EasyCode {

    public function init() {
        
    }
    public function getYoutubeUrlId($e){
        //GET THE URL
        $url = $e;

        $queryString = parse_url($url, PHP_URL_QUERY);

        parse_str($queryString, $params);

        $v = $params['v'];  
        //DISPLAY THE IMAGE
        if(strlen($v)>0){
            //echo $v;  
        echo "https://www.youtube.com/embed/".$v;
        }
    }
    public function chkMobileDevice($url = '') {
        if (Yii::app()->user->isGuest) {
            $detect = Yii::app()->mobileDetect;
            $location = Yii::app()->params->SERVER_HOST . (($url == '') ? Yii::app()->createUrl('//mobile/') : $url);
            if ($_SERVER['HTTP_REFERER'] == 'http://order.wristbands-house.com/') {
                if ($detect->isMobile()) {
                    echo "<script>parent.location = '" . $location . "';</script>";
                } else if ($detect->isTablet()) {
                    echo "<script>parent.location = '" . $location . "';</script>";
                } else {
                    return true;
                }
            } else {
                if ($detect->isMobile()) {
                    echo "<script>parent.location = '" . $location . "';</script>";
                } else if ($detect->isTablet()) {
                    echo "<script>parent.location = '" . $location . "';</script>";
                } else {
                    return true;
                }
            }
        }
    }
    public function getStatus1Options($all = ''){
        if ($all == '')
            return array('1' => 'Enable', '0' => 'Disable');
        else
            return array('' => $all, '1' => 'Enable', '0' => 'Disable');
    }

    function getDistance($addressFrom, $addressTo){
    //Change address format
    $formattedAddrFrom = str_replace(' ','+',$addressFrom);
    $formattedAddrTo = str_replace(' ','+',$addressTo);
    $geoCode = file_get_contents('http://maps.googleapis.com/maps/api/directions/json?origin='.$formattedAddrFrom.'&destination='.$formattedAddrTo.'&alternatives=false&sensor=false&api=AIzaSyDESxjacxSHDo2gQI5lnBqkFX9XeH8lj4c');
    $data = json_decode($geoCode);
    //print_r($data);
    if ($distance = $data->routes[0]->legs[0]){
    return $data;
    }
}
    public function br2nl($text) {

        $breaks = array("<br />", "<br>", "<br/>", "<br />\r\n", "<br>\r\n", "<br/>\r\n", "<br \/>\r\n");

        return str_ireplace($breaks, "\r\n", $text);
    }

    public function nl2br($text) {

        $breaks = array("\r\n");

        return str_ireplace($breaks, "<br>", $text);
    }
    public function makeBookingPdf($id){
        $data['siteName']=SiteSettings::model()->find();
        $data['bookingInfo']=BookingInfo::model()->findByPk($id);
        // $this->renderPartial('bookingPdf', array(
        //     'data' => $data,
        // ));
        $mPDF = Yii::app()->ePdf->mpdf();
        $mPDF = Yii::app()->ePdf->mpdf('', 'A4', 0, '', 5, 5, 5, 5);

        
        $html = $this->renderPartial(Yii::app()->basePath.'/../themes/bookingengine/views/site/bookingPdf', array(
            'data' => $data,
        ), true);

        $stylesheet = file_get_contents(Yii::app()->basePath . '/../themes/admin/assets/global/plugins/bootstrap/css/bootstrap.min.css');
        $stylesheet .= file_get_contents(Yii::app()->basePath . '/../themes/admin/assets/css/custom.css');
        //$mPDF->WriteHTML($stylesheet, 1);
        $mPDF->WriteHTML($html, 2);
        $fileName = $data['bookingInfo']->booking_number. ".pdf";

        $path = UPLOAD .'/bookingPdf/' . $fileName;
        $mPDF->Output($path, 'F');
    }


    public function safeReadFrom($var) {

        return CHtml::encode(trim($var));
    }

    public function loadStatusDropdownOptions() {

        return array('1' => 'Enable', '0' => 'Disable');
    }

    public function getLastSortingNumber($model, $col) {

        $model = new $model;

        $getLastSort = $model->findBySql('select max(' . $col . ') as ' . $col . ' from `' . $model->tableName() . '`');

        return $getLastSort[$col] + 1;
    }

    public function getStatusOptions($all = '') {

        if ($all == '')
            return array('1' => 'Enable', '0' => 'Disable');
        else
            return array('' => $all, '1' => 'Enable', '0' => 'Disable');
    }

    public function getStatus($status) {

        if ($status == '1')
            $val = '<span class="btn btn-success btn-xs">Enabled</span>';
        else
            $val = '<span class="btn btn-danger btn-xs">Disabled</span>';

        return $val;
    }

    public function genPass($pass) {

        return md5($pass);
    }

    public function genFileName($ext) {

        $file = time() . rand(1, 999) . '.' . $ext;

        $path = UPLOAD . '/' . $file;

        if (!file_exists($path))
            return $file;
        else
            $this->genFileName($ext);
    }

    public function showOriginalImage($file, $folder = '/', $type = 'path') {
        if ($file != '') {
            if (file_exists(UPLOAD . $folder . $file)) {
                if ($type == 'path')
                    echo Yii::app()->request->baseurl . '/upload' . $folder . $file;
            }
        }else {
            echo Yii::app()->request->baseurl . '/upload/noimage.jpg';
        }
    }
    public function showOriginalImageLink($file, $folder = '/', $type = 'path') {
        if ($file != '') {
            if (file_exists(UPLOAD . $folder . $file)) {
                if ($type == 'path')
                    return Yii::app()->request->baseurl . '/upload' . $folder . $file;
            }
        }else {
            return Yii::app()->request->baseurl . '/upload/noimage.jpg';
        }
    }
    public function returnOriginalImage($file, $folder = '/', $type = 'path') {
        if ($file != '') {
            if (file_exists(UPLOAD . $folder . $file)) {
                if ($type == 'path')
                    $img=Yii::app()->request->baseurl . '/upload' . $folder . $file;

            echo "<img src='".$img."' width='100'>";
            }
        }else {
            $img=Yii::app()->request->baseurl . '/upload/noimage.jpg';
            echo "<img src='".$img."' width='100'>";
        }
    }

    public function showImage($file, $width, $height, $retunImg = true, $crop = true,$path='/') {

        if ($file != '') {

            if (strpos($file, '/')) {

                $file = $file;
            } else {

                $file = UPLOAD . $path . $file;
            }

            //return CHtml::image($folder.$file,$file);

            if (file_exists($file)) {

                $file = $file;
            } else {

                $file = IMAGE . '/not-found.png';
            }
        } else {

            $file = IMAGE . '/not-found.png';
        }
        try {

            return Yii::app()->thumb->render($file, array(
                        'width' => $width,
                        'height' => $height,
                        //'link' => '#',
                        'hint' => 'false',
                        'crop' => $crop,
                        'sharpen' => 'true',
                        //'longside' => $width,
                        // Any $htmlOptions that can be used in CHtml::image()
                        'imgOptions' => array('class' => 'thumb_image img-responsive', 'width' => $width, 'height' => $height),
                        'imgAlt' => $file,
                            ), $retunImg);
        } Catch (Exception $e) {

            return '';
        }
    }

    public function deleteFile($file,$path='') {

        if ($file != '' && file_exists(UPLOAD . '/'.$path.'/' . $file)) {

            unlink(UPLOAD . '/'.$path.'/' . $file);
        }
    }

    public function showToaster() {

        $var = '';

        if (Yii::app()->user->hasFlash('success')) {

            $var .= "<script type='text/javascript'>jQuery(document).ready(function () {UIToastr.init('success','" . Yii::app()->user->getFlash('success') . "','Success');});</script>";
        }

        if (Yii::app()->user->hasFlash('error')) {

            $var .= "<script type='text/javascript'>jQuery(document).ready(function () {UIToastr.init('error','Error','" . Yii::app()->user->getFlash('error') . "');});</script>";

            //$var .= '<div class="alert alert-danger"><i class="fa fa-times-circle"></i> ' . Yii::app()->user->getFlash('error') . '</div>';
        }

        if (Yii::app()->user->hasFlash('warning')) {

            $var .= "<script type='text/javascript'>jQuery(document).ready(function () {UIToastr.init('warning','Warning','" . Yii::app()->user->getFlash('warning') . "');});</script>";

            //$var .= '<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> ' . Yii::app()->user->getFlash('warning') . '</div>';
        }

        return $var;
    }

    public function showNotification() {

        $var = '';

        if (Yii::app()->user->hasFlash('success')) {

            $var .= '<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' . Yii::app()->user->getFlash('success') . '</div>';
        }

        if (Yii::app()->user->hasFlash('error')) {

            $var .= '<div class="alert alert-danger"><i class="fa fa-times-circle"></i> ' . Yii::app()->user->getFlash('error') . '</div>';
        }

        if (Yii::app()->user->hasFlash('warning')) {

            $var .= '<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> ' . Yii::app()->user->getFlash('warning') . '</div>';
        }

        return $var;
    }

    public function isActive($routes = array(), $module, $id, $controller) {

        $routeCurrent = '';

        if ($module !== null) {

            $routeCurrent .= sprintf('%s/', $module->id);
        }

        $routeCurrent .= sprintf('%s/%s', $id, $controller);

        foreach ($routes as $route) {

            $pattern = sprintf('~%s~', preg_quote($route));

            if (preg_match($pattern, $routeCurrent)) {

                return true;
            }
        }

        return false;
    }

    // function makeSlug($str, $replace = array(), $delimiter = '-') {

    //     if (!empty($replace)) {

    //         $str = str_replace((array) $replace, ' ', $str);
    //     }

    //     $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);

    //     $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);

    //     $clean = strtolower(trim($clean, '-'));

    //     $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

    //     if (preg_match('/\-/', $clean) > 0)
    //         return $clean;
    //     else
    //         return $clean;
    // }
    function makeSlug($model,$name, $action = 'insert') {
        $c = $model::model()->count('name=:name', array(':name' => $name));
        if ($action == 'insert' && $c > 0)
            $name = $name . '-' . ($c + 1);

        /* $seo_st = str_replace(' ', '-', $title);
          $seo_alm = str_replace('--', '-', $seo_st);
          $title_seo = str_replace(' ', '', $seo_alm);
          $title_seo_final = str_replace('/', '-', $title_seo);
          if (strpos($title_seo_final, '-') == false)
          $title_seo_final = $title_seo_final . '-eibela-' . rand(111, 999);

          return urlencode(mb_strtolower($title_seo_final, 'UTF-8')); */
        $string = $name;
        //Make alphanumeric (removes all other characters)
        if (ctype_alnum($string)) {
            $string = strtolower($string);
            $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
            //Clean up multiple dashes or whitespaces
            $string = preg_replace("/[\s-]+/", " ", $string);
            //Convert whitespaces and underscore to dash
            $string = preg_replace("/[\s_]/", "-", $string);
        } else {
            $string = str_replace('  ', '-', $string);
            $string = str_replace(' ', '-', $string);
            $string = str_replace('_', '-', $string);
            $string = str_replace('.', '-', $string);
        }
        $string = strtolower(stripslashes($string));
        $string = preg_replace("|/|", "", $string);
        if (strpos($string, '-') == false)
            $string = $string.'-212';
        return urlencode($string);
    }
    public function getFeatured($status) {

        if ($status == '1')
            $val = '<span class="btn btn-success btn-xs">Yes</span>';
        else
            $val = '<span class="btn btn-danger btn-xs">No</span>';

        return $val;
    }

    public function getExcerpt($str, $startPos = 0, $maxLength = 100) {

        if (strlen($str) > $maxLength) {

            $excerpt = substr($str, $startPos, $maxLength - 3);

            $lastSpace = strrpos($excerpt, ' ');

            $excerpt = substr($excerpt, 0, $lastSpace);

            $excerpt .= '...';
        } else {

            $excerpt = $str;
        }

        return $excerpt;
    }

}
