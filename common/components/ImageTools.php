<?php
namespace common\components;

use yii\imagine\Image;

class ImageTools extends Image {

    public static $driver = [self::DRIVER_IMAGICK, self::DRIVER_GD2, self::DRIVER_GMAGICK];
}