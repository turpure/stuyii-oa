<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChannelSearch represents the model behind the search form about `backend\models\Channel`.
 */
class ChannelSearch extends Channel
{
    public $cate;
    public $subCate;
    public $introducer;
    public $mainImage;

    /**
     * @return string
     */
    //public function getAliasCnName(): string
    public function getAliasCnName()
    {
        return $this->AliasCnName;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'IsLiquid', 'IsPowder', 'isMagnetism', 'IsCharged', 'goodsid', 'SupplierID', 'StoreID', 'bgoodsid'], 'integer'],
            [['introducer','isVar','cate','subCate','description', 'GoodsName', 'AliasCnName', 'AliasEnName', 'PackName', 'Season', 'DictionaryName', 'SupplierName', 'StoreName',
               'completeStatus', 'Purchaser', 'possessMan1', 'possessMan2', 'picUrl', 'GoodsCode', 'achieveStatus', 'devDatetime', 'developer', 'updateTime', 'picStatus', 'AttributeName','cate','subCat'], 'safe'],
            [['DeclaredValue'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param  $model_name
     * @return ActiveDataProvider
     */
    public function search($params,$model_name ='',$unit = '')
    {
        $query = ChannelSearch::find()->orderBy('devDatetime desc');

        //如果是数据中中心模块则只返回已完善数据
        if($model_name == 'oa-data-center'){
            $query->where(['<>','completeStatus','']);
        }
        $query->joinWith(['oa_goods']);
        $query->joinWith(['oa_templates']);
        //返回当前登录用户
        $user = yii::$app->user->identity->username;
        //根据角色 过滤
        $role_sql = yii::$app->db->createCommand("SELECT t2.item_name FROM [user] t1,[auth_assignment] t2 
                    WHERE  t1.id=t2.user_id and
                    username='$user'
                    ");
        $role = $role_sql
            ->queryAll();

        // 返回当前用户管辖下的用户
        $sql = "oa_P_users '{$user}'";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        $users = [];
        foreach ($result as $user) {
            array_push($users, $user['userName']);
        }
    if($unit == '平台信息'){
            if($role[0]['item_name']=='部门主管'){
                $query->andWhere(['in', 'oa_goods.developer', $users]);
            }elseif ($role[0]['item_name']=='产品开发'){
                $query->andWhere(['in', 'oa_goods.developer', $users]);
            }elseif($role[0]['item_name']=='产品开发组长'){
                $query->andWhere(['in', 'oa_goods.developer', $users]);
            }elseif ($role[0]['item_name']=='美工'){
                $query->andWhere(['in', 'possessMan1', $users]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'sort' => [
//                'defaultOrder' => [
//                ]
//            ],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                /* 其它字段不要动 */
                'GoodsCode',
                'GoodsName',
                'SupplierName',
                'StoreName',
                'developer',
                'Purchaser',
                'possessMan1',
                'devDatetime',
                'achieveStatus',
                'DictionaryName',
                'completeStatus',
                /* 下面这段是加入的 */
                /*=============*/
                'cate' => [
                    'asc' => ['oa_goods.cate' => SORT_ASC],
                    'desc' => ['oa_goods.cate' => SORT_DESC],
                    'label' => '主分类'
                ],
                'subCate'=> [
                    'asc' => ['oa_goods.subCate' => SORT_ASC],
                    'desc' => ['oa_goods.subCate' => SORT_DESC],
                    'label' => '子分类'
                ],
                'introducer'=> [
                    'asc' => ['oa_goods.introducer' => SORT_ASC],
                    'desc' => ['oa_goods.introducer' => SORT_DESC],
                    'label' => '推荐人'
                ],
                'isVar',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
      $query->andFilterWhere([
            'pid' => $this->pid,
            'IsLiquid' => $this->IsLiquid,
            'IsPowder' => $this->IsPowder,
            'isMagnetism' => $this->isMagnetism,
            'IsCharged' => $this->IsCharged,
            'DeclaredValue' => $this->DeclaredValue,
            'goodsid' => $this->goodsid,
            'updateTime' => $this->updateTime,
            'SupplierID' => $this->SupplierID,
            'StoreID' => $this->StoreID,
            'bgoodsid' => $this->bgoodsid,
            'isVar' => $this->isVar,
        ]);

        $query
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'GoodsName', $this->GoodsName])
            ->andFilterWhere(['like', 'AliasCnName', $this->AliasCnName])
            ->andFilterWhere(['like', 'AliasEnName', $this->AliasEnName])
            ->andFilterWhere(['like', 'PackName', $this->PackName])
            ->andFilterWhere(['like', 'Season', $this->Season])
            ->andFilterWhere(['like', 'DictionaryName', $this->DictionaryName])
            ->andFilterWhere(['like', 'SupplierName', $this->SupplierName])
            ->andFilterWhere(['like', 'StoreName', $this->StoreName])
            ->andFilterWhere(['like', 'Purchaser', $this->Purchaser])
            ->andFilterWhere(['like', 'possessMan1', $this->possessMan1])
            ->andFilterWhere(['like', 'possessMan2', $this->possessMan2])
            ->andFilterWhere(['like', 'picUrl', $this->picUrl])
            ->andFilterWhere(['like', 'GoodsCode', $this->GoodsCode])
            ->andFilterWhere(['like', 'achieveStatus', $this->achieveStatus])
            ->andFilterWhere(['like', 'oa_goods.developer', $this->developer])
            ->andFilterWhere(['like', 'picStatus', '已完善'])
            ->andFilterWhere(['like', 'AttributeName', $this->AttributeName])
            ->andFilterWhere(['like', 'oa_goods.cate', $this->cate])
            ->andFilterWhere(['like', 'oa_goods.subCate', $this->subCate])
            ->andFilterWhere(['like', 'convert(varchar(10),devDatetime,120)', strval($this->devDatetime)])
            ->andFilterWhere(['like', 'completeStatus', $this->completeStatus])
            ->andFilterWhere(['like', 'oa_goods.introducer', $this->introducer]);
        //var_dump($dataProvider->prepare());exit;
        Yii::$app->db->cache(function($db) use($dataProvider){
            $dataProvider->prepare();
        }, 60);
        return $dataProvider;
    }
}
