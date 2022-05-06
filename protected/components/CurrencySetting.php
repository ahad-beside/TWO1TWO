<?php

class CurrencySetting extends CApplicationComponent {

    public function __construct() {

        //unset(Yii::app()->session['currency']);

        /* Check country and Set currency */
        if (!isset(Yii::app()->session['currency'])) {
            $country = Country::model()->findAll(array('condition' => 'code!="SG"'));

            $countryArray = array();
            foreach ($country as $cc):
                $countryArray[] = $cc->code;
            endforeach;

            $ip_details = Yii::app()->easycode->get_geoPlugin(Yii::app()->easycode->get_ip());

            //echo $ip_details['geoplugin_countryCode'];

            if (in_array($ip_details['geoplugin_countryCode'], $countryArray)) {
                //Yii::app()->request->redirect(array('//site/changeCurrency'));
                //exit();
                $this->setCurrency('2');

                //echo Yii::app()->currency->getSymbol();
            }
        }
    }

    function getCurrentCurrency() {
        if (isset(Yii::app()->session['currency'])) {
            return Yii::app()->session['currency'];
        } else {
//            $cl = Currency::model()->find('`status`=1 and `default`=1');
//            if (count($cl) > 0) {
//                $cur = array(
//                    'id' => $cl->id,
//                    'label' => $cl->label,
//                    'rate' => $cl->rate,
//                    'flag' => $cl->flag,
//                );
//            } else {
//                $cur = array();
//            }
//            Yii::app()->session['currency'] = $cur;
//            return Yii::app()->session['currency'];
            
            $country = Country::model()->findAll(array('condition' => 'code!="SG"'));
            $countryArray = array();
            foreach ($country as $cc):
                $countryArray[] = $cc->code;
            endforeach;
            $ip=Yii::app()->easycode->get_ip();
            $geopluginURL ='http://www.geoplugin.net/php.gp?ip='.$ip;
            
            $ip_details=unserialize(file_get_contents($geopluginURL));
            if (in_array($ip_details['geoplugin_countryCode'], $countryArray)) {
                //Yii::app()->request->redirect(array('//site/changeCurrency'));
                //exit();
                $id=2;
                 $cl = Currency::model()->findByPk($id);
        if (count($cl) > 0) {
            $cur = array(
                'id' => $cl->id,
                'label' => $cl->label,
                'rate' => $cl->rate,
                'flag' => $cl->flag,
            );
            Yii::app()->session['currency'] = $cur;
        }
                //echo Yii::app()->currency->getSymbol();
            }else{
              $id=1;
                 $cl = Currency::model()->findByPk($id);
        if (count($cl) > 0) {
            $cur = array(
                'id' => $cl->id,
                'label' => $cl->label,
                'rate' => $cl->rate,
                'flag' => $cl->flag,
            );
            Yii::app()->session['currency'] = $cur;
        }  
            }
        return Yii::app()->session['currency'];
        }
    }

    function setCurrency($id) {
        $cl = Currency::model()->findByPk($id);
        if (count($cl) > 0) {
            $cur = array(
                'id' => $cl->id,
                'label' => $cl->label,
                'rate' => $cl->rate,
                'flag' => $cl->flag,
            );
            Yii::app()->session['currency'] = $cur;
        }
    }
    
    function convertToUsd($price,$label=''){
        $cl = Currency::model()->findByPk(2);
        $price = $price * $cl->rate;
        return number_format($price, Yii::app()->params->decimalPoint);
    }

    function convert($price, $withSymbol = true) {
        $cur = $this->getCurrentCurrency();
        if ($withSymbol)
            $symbol = $cur['label'] . ' ';
        else
            $symbol = '';
        return $symbol . number_format($price * $cur['rate'], Yii::app()->params->decimalPoint);
    }

    function convertNew($price) {
        $cur = $this->getCurrentCurrency();
        return $price*$cur['rate'];
    }
    function convertCart($price, $withSymbol = true, $curSymbol) {
        $cur = $this->getCurrentCurrency();
        if ($withSymbol)
            $symbol = $cur['label'] . ' ';
        else
            $symbol = '';

        if ($curSymbol == $cur['label'])
            $price = $price;
        else if ($cur['label'] == 'USD')
            $price = $price * $cur['rate'];
        else
            $price = $price / $cur['rate'];

        return $symbol . number_format($price, Yii::app()->params->decimalPoint).$curSymbol;
    }

    function getSymbol() {
        $cur = $this->getCurrentCurrency();
        return $cur['label'];
    }

    function priceInsideMsg($price = 20) {
        return $this->convert($price, false);
    }

    function secondInkColor($price = 0.15) {
        return $this->convert($price, false);
    }

}