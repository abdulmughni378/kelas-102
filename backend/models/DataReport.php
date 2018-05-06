<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\components\Helper;
use yii\db\Query;

class DataReport extends Model
{

	public function getBoxesData()
    {
        $userRegistration = $this->getDataUserRegistration();
		$product = $this->getDataProducts();
		$fin = array();


        // $fin['JML_RP_TAHUN'] = Helper::digits($dataTahun['JUMLAH_RP_TAHUN']);
        $fin['USER_REGISTRATION'] = $userRegistration['JUMLAH'];
        $fin['PRODUCT']           = $product['JUMLAH'];

        return empty($fin) ? 0 : $fin;
    }

    private function getDataUserRegistration()
    {
        try {

            $query = new Query;
            $query->select(['COUNT(*) as `JUMLAH`'])
                  ->from('users');

            $command = $query->createCommand(Yii::$app->db);
            $command = $command->queryOne();

            return $command;

        } catch (Exception $ex) {
            echo 'Query failed', $ex->getMessage();
        }

        return false;
    }

    private function getDataProducts()
    {
        try {

            $query = new Query;
            $query->select(['COUNT(*) as `JUMLAH`'])
                  ->from('product');

            $command = $query->createCommand(Yii::$app->db);
            $command = $command->queryOne();

            return $command;

        } catch (Exception $ex) {
            echo 'Query failed', $ex->getMessage();
        }

        return false;
    }

}
