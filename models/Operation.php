<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "operation".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $sum
 * @property string $batch
 * @property integer $created_at
 * @property integer $confirmed_at
 * @property integer $status
 * @property string $memo
 * @property integer $case_id
 * @property integer $ref_id
 */
class Operation extends \yii\db\ActiveRecord {

    const STATUS_NOT_CONFIRMED = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_CANCEL = 2;

    public $username;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'operation';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['user_id', 'created_at', 'confirmed_at', 'status', 'case_id', 'ref_id'], 'integer'],
                [['sum'], 'number'],
                [['type'], 'string', 'max' => 16],
                [['batch', 'memo'], 'string', 'max' => 255],
            //step1
            ['type', 'required'],
                ['type', 'in', 'range' => ['CASHIN', 'CASHOUT', 'OPEN', 'PRIZE', 'REF', 'BONUS']],
                ['username', 'required'],
                ['username', 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'username']
        ];
    }

    public function scenarios() {
        $scenarions = parent::scenarios();
        return \yii\helpers\ArrayHelper::merge($scenarions, [
                    'step1' => ['username', 'type']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'typename' => 'Type',
            'sum' => 'Sum',
            'batch' => 'Batch',
            'created_at' => 'Created At',
            'confirmed_at' => 'Confirmed At',
            'status' => 'Status',
            'statusName' => 'Status',
            'memo' => 'Memo',
            'case_id' => 'Case ID',
            'ref_id' => 'Ref ID',
        ];
    }

    public function getTypename() {
        $types = self::getTypesname();
        return isset($types[$this->type])?$types[$this->type]:'';
    }

    public static function getTypesname() {
        return [
            'CASHIN' => 'Пополнение',
            'CASHOUT' => 'Вывод',
            'OPEN' => 'Открытие кейса',
            'PRIZE' => 'Выигрыш',
            'REF' => 'Рефские',
            'BONUS' => 'Бонус'
        ];
    }
    
    public static function getStatusesNames(){
        return [
            self::STATUS_CONFIRMED => 'Подтверждена',
            self::STATUS_NOT_CONFIRMED => 'Не подтверждена',
            self::STATUS_CANCEL => 'Отменена',
        ];
    }
    
    public function getStatusName(){
        $statuses = self::getStatusesNames();
        return isset($statuses[$this->status])?$statuses[$this->status]:'';
    }

    public function afterValidate() {
        parent::afterValidate();
        $this->setUserIdByUsername();
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUserlogin() {
        return ($this->user)?$this->user->username:null;
    }

    public function setUserIdByUsername() {
        if ($this->username) {
            $user = User::findOne(['username' => $this->username]);
            if($user){
                $this->user_id = $user->id;
            }
        }
    }

    public function setUsernameById() {
        $this->username = $this->getUserlogin();
    }

    public function afterFind() {
        $this->setUsernameById();
    }

    public static function instantiate($row) {
        parent::instantiate($row);
        $classname = 'app\\models\\Operation_' . $row['type'];
        return new $classname;
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if($insert){
                $this->created_at = time();
                if (!$this->status) {
                    $this->status = self::STATUS_NOT_CONFIRMED;
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    public function confirm(){
        if(static::process()){
            $this->confirmed_at = time();
            $this->status = self::STATUS_CONFIRMED;
            $this->save();
        }
    }
    
    public function cancel(){
        $this->status = self::STATUS_CANCEL;
        $this->save();
    }
        
}
