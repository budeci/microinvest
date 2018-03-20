<?php
namespace yii\helpers;
use common\models\Text;
class UI extends BaseArrayHelper
{
    public static function getVar($id)
    {
        return Text::find()->where('id = '.$id)->one()->text;
    }
}