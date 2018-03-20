<?php
namespace common\models;

use Yii;
//use yii\base\NotSupportedException;
//use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
//use yii\web\IdentityInterface;

class Products extends ActiveRecord{

	public static $currency = 70;

	public $img;
	public $full_price = 0;
	public $full_price_v = 0;
	public $price_rub = 0;

	public static $statuses = [
		'Y' => 'Активен',
		'N' => 'Скрыт'
	];

	public static $is_comings = [
		'Y' => 'Да',
		'N' => 'Нет'
	];
	
	public static $extra_info_statuses = [
		'Y' => 'Показать',
		'N' => 'Скрыть'
	];
	
	public static $question = [
		'Y' => 'Да',
		'N' => 'Нет'
	];

	public static $colors = [
		'N' => '-',
		'B' => 'Бежевый',
		'C' => 'Капучино',
		'P' => 'Черный',
		'R' => 'Розовый',
		'S' => 'Синий',
		'F' => 'Пурпурный',
		'O' => 'Оранжевый',
		'G' => 'Салатовый',
		'GR' => 'Серый'
	];

	public static $colors_values = [
		'N' => '-',
		'B' => '#fadba5',
		'C' => '#af8553',
		'P' => '#000',
		'R' => '#c83168',
		'S' => '#25467c',
		'F' => '#bc8b7a',
		'O' => '#fcaa92',
		'G' => '#e2f7b2',
		'GR' => '#8b8e9d'
	];

	public static $sizes = [
		'4' => '60-65',
		'6' => '65-70',
		'8' => '70-75',
		'10' => '75-80',
		'12' => '80-85',
		'14' => '85-90',
		'16' => '90-95',
		'18' => '95-100',
		'20' => '100-105',
		'22' => '105-110',
		'XS' => '60-66',
		'S' => '67-73',
		'M' => '74-80',
		'L' => '81-87',
		'XL' => '88-94',
		'XXL' => '95-101',
		'XXXL' => '102-120',
		'4XL' => '111-119',
		'5XL' => '120-128',
		'6XL' => '129-140',
		'S/M' => '66-81',
		'L/XL' => '82-97',
		'2XL/3XL' => '98-120'
	];
	
	public static $sizes_t = [
		'4' => '60-65',
		'6' => '65-70',
		'8' => '70-75',
		'10' => '75-80',
		'12' => '80-85',
		'14' => '85-90',
		'16' => '90-95',
		'18' => '95-100',
		'20' => '100-105',
		'22' => '105-110',
		'XS' => '60-66',
		'S' => '67-73',
		'M' => '74-80',
		'L' => '81-87',
		'XL' => '88-94',
		'XXL' => '95-101',
		'XXXL' => '102-110',
		'4XL' => '111-119',
		'5XL' => '120-128',
		'6XL' => '129-140',
		'S/M' => '66-81',
		'L/XL' => '82-97',
		'2XL/3XXL' => '98-120'
	];

	public static $sizes_t2 = [
		'4' => '60-65',
		'6' => '65-70',
		'8' => '70-75',
		'10' => '75-80',
		'12' => '80-85',
		'14' => '85-90',
		'16' => '90-95',
		'18' => '95-100',
		'20' => '100-105',
		'22' => '105-110',
		'XS' => '60-66',
		'S' => '66-81',
		'M' => '66-81',
		'L' => '82-97',
		'XL' => '82-97',
		'XXL' => '98-120',
		'XXXL' => '98-120',
		'4XL' => '111-119',
		'5XL' => '120-128',
		'6XL' => '129-140',
		'S/M' => '66-81',
		'L/XL' => '82-97',
		'2XL/3XXL' => '98-120'
	];

	public static $categories = [
		'1' => 'Корсеты',
		'2' => 'Послеродовое белье',
		'3' => 'Послеоперационное белье',
		'4' => 'Утягивающее белье',
		'5' => 'Моделирующее белье',
		'6' => 'Легкая коррекция'
	];

	public static $orders = [
		'1' => 'по увеличению цены',
		'2' => 'по уменьшению цены',
		'3' => 'по названию',
		'4' => 'по новизне',
		'5' => 'по рейтингу',
		'6' => 'по популярности'
	];

	public static $orders_sql = [
		'1' => 'price',
		'2' => 'price DESC',
		'3' => 'title',
		'4' => 'is_new',
		'5' => 'title',
		'6' => 'is_popular'
	];

	public static $application_areas = [
		'W' => 'Пешеходные зоны, тротуары, скверы, парки, велосипедные дорожки, индивидуальная застройка.',
		'G' => 'Индивидуальная застройка, частные гаражи для легковых автомобилей.',
		'R' => 'Обочины автодорог, стоянки автомобилей, гаражи.',
		'A' => 'АЗС, автомойки, автопредприятия, траспортные терминалы, промышленные зоны.',
		'I' => 'Промышленные предприятия, причалы, склады.',
		'H' => 'Области высоких нагрузок на дорожное покрытие, аэропорты, военные базы, грузовые терминалы.',
	];

	public static $application_areas_icons = [
		'W' => 'walk',
		'G' => 'garage',
		'R' => 'road',
		'A' => 'azs',
		'I' => 'industrial',
		'H' => '',
	];

	public static function tableName(){
		return 'products';
	}

	public function afterFind(){

		//$this->full_price = number_format($this->price * self::$currency, 0, '', ' ');
		//$this->price_rub = $this->price * self::$currency;

		$this->full_price = $this->price_rub = $this->price;

		if(defined('IS_FRONTEND') && $this->percent > 0){
			$this->full_price = number_format($this->price - (($this->price / 100) * $this->percent), 2);

			$this->full_price_v = ($this->price - (($this->price / 100) * $this->percent));
			$this->old_price = $this->price;

if($this->id == 5){
//echo $this->full_price_v;
}
		}
		else{
		    $this->full_price_v = $this->price;
		}

		$q = ProductsImages::find()
			->where('id_product = '.$this->id)
			->orderBy('sort')
			->one();

		if($q){
			$this->img = $q;
		}

		return parent::afterFind();
	}

	public function getCategory(){
		return $this->hasOne(ProductsCategories::className(), ['id_product' => 'id']);
	}

	public function category(){ 
		return $this->hasOne(Category::className(), ['id' => 'id_category']);
	}

	public function getCategories(){
		return $this->hasMany(ProductsCategories::className(), ['id_product' => 'id']);
	}

	public function getImages(){
		return $this->hasMany(ProductsImages::className(), ['id_product' => 'id']);
	}

	public function getRemains(){

		$remain = [];

		$q = ProductsStore::find()->where('id_product = '.$this->id)->all();

		foreach($q AS $e){
			if(!isset($remain[$e->color])){
				$remain[$e->color] = [];
			}

			if($e->quantity > 0){
				$remain[$e->color][$e->size] = $e->quantity;
			}
		}

		return $remain;
	}

/*
	public static function find(){
        return Yii::createObject(MyActiveQuery::className(), [get_called_class()]);
    }

    public function afterSave($insert, $changedAttributes){
	Yii::$app->cache->flush();

	return parent::afterSave($insert, $changedAttributes);
    }*/
}