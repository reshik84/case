<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "case".
 *
 * @property integer $id
 * @property string $name
 * @property string $sum
 * @property string $min
 * @property string $max
 * @property string $real_max
 * @property integer $risk
 * @property integer $active
 * @property integer $created_at
 * @property integer $updated_at
 */
class Cases extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'case';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sum', 'min', 'max', 'real_max'], 'required'],
            [['sum', 'min', 'max', 'real_max'], 'number', 'min' => 0],
            [['risk', 'active', 'created_at', 'updated_at'], 'integer', 'min' => 0, 'max' => 100],
            [['name'], 'string', 'max' => 255],
            ['image', 'image', 'extensions' => 'jpg, jpeg, gif, png'],
            ['image2', 'image', 'extensions' => 'jpg, jpeg, gif, png'],
            [['image', 'image2'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sum' => 'Sum',
            'min' => 'Min',
            'max' => 'Max',
            'real_max' => 'Real Max',
            'risk' => 'Risk',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        return ArrayHelper::merge($scenarios, [
            'insert' => ['name','sum','min','max','real_max','risk','active','image', 'image2'],
            'update' => ['name','sum','min','max','real_max','risk','active','image', 'image2'],
        ]);
    }
    
    public function behaviors() {
        return [
            'image' => [
                'class' => \mongosoft\file\UploadImageBehavior::className(),
                'attribute' => 'image',
                'scenarios' => ['insert', 'update'],
                'path' => '@webroot/upload/case/{id}',
                'url' => '@web/upload/case/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 400, 'quality' => 90],
                    'preview' => ['width' => 200, 'height' => 200],
                ],
            ],
            'image2' => [
                'class' => \mongosoft\file\UploadImageBehavior::className(),
                'attribute' => 'image2',
                'scenarios' => ['insert', 'update'],
                'path' => '@webroot/upload/case/{id}_open',
                'url' => '@web/upload/case/{id}_open',
                'thumbs' => [
                    'thumb' => ['width' => 400, 'quality' => 90],
                    'preview' => ['width' => 200, 'height' => 200],
                ],
            ],
        ];
    }
    
    public static function find(){
        return new CasesQuery(get_called_class());
    }
    
    
}
