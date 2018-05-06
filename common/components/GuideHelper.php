<?php 
namespace common\components;

use Yii;
use yii\web\Request;
use yii\helpers\Html;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use common\models\GuideCategory;
use common\models\Product;
use common\models\ProductImage;
use common\models\ProductType;
use common\models\Brand;

// as class content front helper
class GuideHelper
{

	public function getGuideCategoryGedungAtas()
    {
        return GuideCategory::find()->where(['guide_category_parent' => '1'])->all();
        // return GuideCategory::find()->where(['guide_category_id' => '1'])->all();
    }

    public function getGuideCategoryGedungBawah()
    {
        return GuideCategory::find()->where(['guide_category_parent' => '4'])->all();
        // return GuideCategory::find()->where(['guide_category_id' => '1'])->all();
    }

    public function getGuideCategoryInfrastruktur()
    {
        return GuideCategory::find()->where(['guide_category_parent' => '11'])->all();
        // return GuideCategory::find()->where(['guide_category_id' => '1'])->all();
    }

    public function getProductImage()
    {

    	$product = ProductImage::find()->groupBy('product_id')->all();

    	return $product;
    }

    public function getProductCategory()
    {

    	$product = Product::find()->groupBy('product_type_product_type_id')->all();

    	return $product;
    }

    public function getProductCategoryNew()
    {

        $product = ProductType::find()->where(['parent_product_type' => '0'])->orderBy(["-`order`" => SORT_DESC])->all();

        return $product;
    }

    public function getProductTerpilih()
    {

    	$product = Product::find()->where(['product_status' => '1'])->orderBy(['created_at' => SORT_DESC])->limit('6')->all();

    	return $product;
    }

    public function getBrand()
    {

    	$product = Brand::find()->orderBy(["-`order`" => SORT_DESC])->all();

    	return $product;
    }

}