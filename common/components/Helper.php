<?php 
namespace common\components;

use Yii;
use yii\web\Request;
use yii\helpers\Html;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use common\models\User;

class Helper
{

	function __construct()
	{
		date_default_timezone_set("Asia/Jakarta");
	}

	public static function dateTimeFormat($dateTime = '0000-00-00 00:00:00')
    {
        if ($dateTime != '0000-00-00 00:00:00') {
            return date('d F Y H:i:s', strtotime($dateTime));
        }
        return '-';
    }

    public static function dateFormat($date = '0000-00-00')
    {
        if ($date != '0000-00-00') {
            return date('d F Y', strtotime($date));
        }
        return '-';
    }

    public static function rupiahFormat($amount)
    {
        return 'Rp. '.number_format((double)$amount, 0, ",", ".");
    }

    public static function persenFormat($amount)
    {
        return $amount . ' %';
    }

    public static function blame($userBy)
    {
        if (!empty($userBy)) {
            return User::findIdentityBlame($userBy)->username;
        }

        return '-';
    }

}