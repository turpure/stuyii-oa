<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = '数据详情';

?>
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
<script src="https://cdn.bootcss.com/vue-resource/1.5.0/vue-resource.min.js"></script>

<?php
echo "<div><img src='{$mine->MainImage}' width=60 height=60}></div>";
?>


<?php $form = ActiveForm::begin([
    'id' => 'detail-form',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'class' => 'radius-input',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]
]);
?>
<div class="blockTitle" >
    <span>基本信息</span>
</div>

<?= $form->field($mine,'proName')?>
<?= $form->field($mine,'tags')?>
<?= $form->field($mine,'parentId')?>
<?= $form->field($mine,'description')->textarea(['style' => "width: 885px; height: 282px;"])?>

<div class="blockTitle" >
    <span>图片信息</span>
</div>
<?php
echo $form->field($mine, 'MainImage')->textInput(['class' => 'img','style' => 'margin-top:2%;width:50%']);
for($i=0;$i<=10;$i++){
    $extra_image = 'extra_image'.(string)$i;
    echo $form->field($mine, $extra_image,[])->textInput(['class' => 'img','style' => 'margin-top:2%;width:50%']);
}
?>



<div class="blockTitle" >
    <span>多属性信息</span>
</div>
<div>
    <div id="app" style="margin-bottom: 5%">
        <template>
            <el-table :data="tableData" style="width: 100%">
                <el-table-column
                        type="index"
                        width="50">
                </el-table-column>
                <el-table-column
                        fixed="right"
                        label="操作"
                        width="120">
                    <template slot-scope="scope">
                        <el-button
                                @click.native.prevent="deleteRow(scope.$index, tableData)"
                                type="text"
                                size="small">
                            移除
                        </el-button>
                        <el-button
                                @click.native.prevent="addRow(tableData)"
                                type="text"
                                size="small">
                            增加
                        </el-button>
                    </template>
                </el-table-column>
                <el-table-column v-if="false" prop="id" label="编号" ></el-table-column>
                <el-table-column prop="childId" label="唯一编码">
                    <template slot-scope="scope">
                        <el-input v-model="scope.row.childId"  size="small" controls-position="right" />
                    </template>
                </el-table-column>
                <el-table-column prop="color" label="颜色">
                    <template slot-scope="scope">
                        <el-input v-model="scope.row.color"  size="small" controls-position="right" />
                    </template>
                </el-table-column>
                <el-table-column prop="proSize" label="尺码/型号">
                    <template slot-scope="scope">
                        <el-input v-model="scope.row.proSize"  size="small" controls-position="right" />
                    </template>
                </el-table-column>
                <el-table-column prop="quantity" label="库存">
                    <template slot-scope="scope">
                        <el-input v-model="scope.row.quantity"  size="small" controls-position="right" />
                    </template>
                </el-table-column>
                <el-table-column prop="price" label="价格">
                    <template slot-scope="scope">
                        <el-input v-model="scope.row.price"  size="small" controls-position="right" />
                    </template>
                </el-table-column>
                <el-table-column prop="msrPrice" label="MSR价格">
                    <template slot-scope="scope">
                        <el-input v-model="scope.row.msrPrice"  size="small" controls-position="right" />
                    </template>
                </el-table-column>
                <el-table-column prop="shipping" label="运费">
                    <template slot-scope="scope">
                        <el-input v-model="scope.row.shipping"  size="small" controls-position="right" />
                    </template>
                </el-table-column>
                <el-table-column prop="shippingWeight" label="重量">
                    <template slot-scope="scope">
                        <el-input v-model="scope.row.shippingWeight"  size="small" controls-position="right" />
                    </template>
                </el-table-column>
                <el-table-column prop="shippingTime" label="配送时长">
                    <template slot-scope="scope">
                        <el-input v-model="scope.row.shippingTime"  size="small" controls-position="right" />
                    </template>
                </el-table-column>
                <el-table-column label="图片" width="180">
                    <template scope="scope">
                        <image :src="scope.row.varMainImage" width="50" height="50"/>
                    </template>
                </el-table-column>
            </el-table>
        </template>
        <div style="margin-top: 3%; margin-left: 5%">
            <el-row>
                <el-button id="save-btn" type="primary" round>保存数据</el-button>
                <el-button id="export-btn" type="success" round>导出数据</el-button>
            </el-row>
        </div>
        <span id='table-data' style="display: none">{{tableData}}</span>
    </div>
</div>

<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
<?php ActiveForm::end() ?>


<style>
    .blockTitle {
        font-size: 16px;
        background-color: #f7f7f7;
        border-top: 0.5px solid #eee;
        border-bottom: 0.5px solid #eee;
        padding: 2px 12px;
        margin-left: -5px;
        margin-bottom: 2%;
        margin-top: 2%;
    }

    .blockTitle span {
        margin-top: 20px;
        font-weight: bold;
    }

    #detail-form input {
        border-radius: 10px;                /* 圆角边框 */
    }

    #detail-form textarea {
        border-radius: 10px;                /* 圆角边框 */
    }

    .thumbnail:hover {
        border: 2px solid #00a65a;
    }

    .el-table__body input {
        border-radius: 15px ;
    }


    #back-to-top {
        position: fixed;
        bottom: 40px;
        right: 40px;
        z-index: 9999;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 30px;
        background: #f5f5f5;
        color: #444;
        cursor: pointer;
        border: 0;
        border-radius: 5px;
        text-decoration: none;
        transition: opacity 0.2s ease-out;
        opacity: 0;
    }
    #back-to-top:hover {
        background: #e9ebec;
    }
    #back-to-top.show {
        opacity: 1;
    }

</style>



<script>

    new Vue({
        el: '#app',

        data: function() {
            return {
                tableData: [],
                loading: true,
            }
        },
        created: function () {
            var detailUrl = window.location.href.replace('update','mine-detail');
            this.$http({url:detailUrl}).then(function (response) {
                var ret =  response.body;
                this.tableData = ret;
                this.loading = false;
            })
        },
        methods:{
            deleteRow: function(index, rows) {
                var id = rows[index].id;
                rows.splice(index, 1);
                $.get('delete-detail',{'id':id});
            },
            addRow: function (rows) {
                console.log(rows);
                var row = {
                    'childId': '',
                    'color': '',
                    'id': '',
                    'msrPrice': '',
                    'price': '',
                    'proSize': '',
                    'quantity': '',
                    'shipping': '',
                    'shippingTime': '',
                    'shippingWeight': '',
                    'varMainImage': ''
                };
                rows.push(row);
            }
        }
    })

</script>


<?php

$exportUrl = Url::toRoute(['export', 'mid' => $mid ]);
$saveUrl = Url::toRoute(['save', 'mid' => $mid ]);
$js = <<<JS

/*
back to top
 */

if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}

/*
export to csv
 */
$('#export-btn').on('click',function() {
    window.location = '$exportUrl';
})

/*
save data
 */
$('#save-btn').on('click',function() {
    var tableData = $('#table-data').text();
    console.log(tableData);
    var formData = $('form#detail-form').serializeObject();
    $.ajax({
        url:'$saveUrl',
        type:'post',
        data:{'tableData':tableData, 'formData':formData},
        success:function(res) {
            alert(res);
        }
    });
})


$.prototype.serializeObject = function() {  
    var a, o, h, i, e;  
    a = this.serializeArray();  
    o = {};  
    h = o.hasOwnProperty;  
    for (i = 0; i < a.length; i++) {  
        e = a[i];  
        if (!h.call(o, e.name)) {  
            var key = e.name.replace('OaDataMineDetail[','').replace(']','')
            o[key] = e.value;  
        }  
    }  
    return o;
};   


/*
show image
 */


JS;


$this->registerJs($js);
?>