<?php 
namespace common\components;

use Yii;
use yii\web\Request;
use yii\helpers\Html;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use common\models\SocialMedia;
use common\models\Logo;
use common\models\PaymentsIcon;
use common\models\ContactUs;


class Content
{

	public $baseUrlImage;

	function __construct($baseUrlImage = null)
	{
		$this->baseUrlImage = Yii::getAlias('@web') . '/template/img/';

		// return $baseUrlImage;
	}

	private function logo()
	{
		$logo = Logo::find()->one();
		return $logo;
	}

	public function footerLogo()
	{
		return '<img alt="'.$this->logo()->name.'" class="img-responsive" src="'.$this->baseUrlImage.$this->logo()->image_url.'">';
	}

	public function headerLogo()
	{
		return '<img alt="'.$this->logo()->name.'" width="111" height="51" src="'.$this->baseUrlImage.$this->logo()->image_url.'">';
	}

	public function paymentsIcon()
	{
		$paymentsIcon = PaymentsIcon::find()->groupBy('name')->all();
		return $paymentsIcon;
	}

	public function socialMedia()
	{
		$socialMedia = SocialMedia::find()->select("type, url, name_account")->groupBy('type')->all();
		return $socialMedia;
	}

	public static function kontakKami()
	{
		$contactUs = ContactUs::find()->one();
		return $contactUs;
	}

}