<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 10/27/2014
 * @Time 3:01 PM
 */

return [
    'config' => [
        'onlinePayment' => [
            'label' => Yii::t('core_payment', '线上支付接口管理'),
            'sort' => 200,
            'groups' => [
                'ecpss' => [
                    'label' => Yii::t('core_payment', '汇潮支付'),
                    'sort' => 10,
                    'fields' => [
                        'isEnable' => [  //field
                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
                            'sort' => 10,
                            'type' => 'radio',               //the input type: text, select, checkbox, radio
                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
                            'value' => '1',               //the default value
                        ],
                        'feeRate' => [
                            'label' => Yii::t('core_payment', '充值手续费'),
                            'sort' => 20,
                            'type' => 'text',
                            'value' => '0.2',
                        ],
                        'MerNo' => [
                            'label' => Yii::t('core_payment', '商户号'),
                            'sort' => 30,
                            'type' => 'text',
                            'value' => '19769',
                        ],
                        'MD5key' => [
                            'label' => Yii::t('core_payment', '支付密钥'),
                            'sort' => 30,
                            'type' => 'password',
                            'value' => 'objmKc[b',
                        ]
                    ]
                ],
//                'ips' => [
//                    'label' => Yii::t('core_payment', '环迅支付'),
//                    'sort' => 20,
//                    'fields' => [
//                        'isEnable' => [  //field
//                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
//                            'sort' => 10,
//                            'type' => 'radio',               //the input type: text, select, checkbox, radio
//                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
//                            'value' => '0',               //the default value
//                        ],
//                        'feeRate' => [
//                            'label' => Yii::t('core_payment', '充值手续费'),
//                            'sort' => 20,
//                            'type' => 'text',
//                            'value' => '',
//                        ],
//                        'MerNo' => [
//                            'label' => Yii::t('core_payment', '商户号'),
//                            'sort' => 30,
//                            'type' => 'text',
//                            'value' => '',
//                        ],
//                        'MerKey' => [
//                            'label' => Yii::t('core_payment', '商户证书'),
//                            'sort' => 30,
//                            'type' => 'text',
//                            'value' => '',
//                        ]
//                    ]
//                ],
                'chinaBank' => [
                    'label' => Yii::t('core_payment', '网银在线'),
                    'sort' => 30,
                    'fields' => [
                        'isEnable' => [  //field
                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
                            'sort' => 10,
                            'type' => 'radio',               //the input type: text, select, checkbox, radio
                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
                            'value' => '1',               //the default value
                        ],
                        'feeRate' => [
                            'label' => Yii::t('core_payment', '充值手续费'),
                            'sort' => 20,
                            'type' => 'text',
                            'value' => '0.2',
                        ],
                        'mid' => [
                            'label' => Yii::t('core_payment', '商户号'),
                            'sort' => 30,
                            'type' => 'text',
                            'value' => '23091132',
                        ],
                        'mKey' => [
                            'label' => Yii::t('core_payment', 'MD5密钥'),
                            'sort' => 30,
                            'type' => 'password',
                            'value' => '285279781@qq.comronxindai2014',
                        ]
                    ]
                ],
                'baoFoo' => [
                    'label' => Yii::t('core_payment', '宝付'),
                    'sort' => 40,
                    'fields' => [
                        'isEnable' => [  //field
                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
                            'sort' => 10,
                            'type' => 'radio',               //the input type: text, select, checkbox, radio
                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
                            'value' => '1',               //the default value
                        ],
                        'feeRate' => [
                            'label' => Yii::t('core_payment', '充值手续费'),
                            'sort' => 20,
                            'type' => 'text',
                            'value' => '0.2',
                        ],
                        'MemberID' => [
                            'label' => Yii::t('core_payment', '商户号'),
                            'sort' => 30,
                            'type' => 'text',
                            'value' => '404203',
                        ],
                        'TerminalID' => [
                            'label' => Yii::t('core_payment', '终端号'),
                            'sort' => 30,
                            'type' => 'password',
                            'value' => '21128',
                        ],
                        'pKey' => [
                            'label' => Yii::t('core_payment', '商户证书'),
                            'sort' => 30,
                            'type' => 'password',
                            'value' => 'uqflvf323wjs3j6t',
                        ]
                    ]
                ],
                'sumaPay' => [
                    'label' => Yii::t('core_payment', '丰付'),
                    'sort' => 40,
                    'fields' => [
                        'isEnable' => [  //field
                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
                            'sort' => 10,
                            'type' => 'radio',               //the input type: text, select, checkbox, radio
                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
                            'value' => '1',               //the default value
                        ],
                        'feeRate' => [
                            'label' => Yii::t('core_payment', '充值手续费'),
                            'sort' => 20,
                            'type' => 'text',
                            'value' => '0.2',
                        ],
                        'partner' => [
                            'label' => Yii::t('core_payment', '商户号'),
                            'sort' => 30,
                            'type' => 'text',
                            'value' => '3310000040',
                        ],
                        'key' => [
                            'label' => Yii::t('core_payment', '商户证书'),
                            'sort' => 30,
                            'type' => 'password',
                            'value' => 'yRhMmS5tUXJLjUfDES9ki6USKm8TWBIe',
                        ]
                    ]
                ],
//                'tenPay' => [
//                    'label' => Yii::t('core_payment', '财付通'),
//                    'sort' => 50,
//                    'fields' => [
//                        'isEnable' => [  //field
//                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
//                            'sort' => 10,
//                            'type' => 'radio',               //the input type: text, select, checkbox, radio
//                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
//                            'value' => '0',               //the default value
//                        ],
//                        'feeRate' => [
//                            'label' => Yii::t('core_payment', '充值手续费'),
//                            'sort' => 20,
//                            'type' => 'text',
//                            'value' => '',
//                        ],
//                        'MerNo' => [
//                            'label' => Yii::t('core_payment', '商户号'),
//                            'sort' => 30,
//                            'type' => 'text',
//                            'value' => '',
//                        ],
//                        'MerKey' => [
//                            'label' => Yii::t('core_payment', '支付密钥'),
//                            'sort' => 30,
//                            'type' => 'password',
//                            'value' => '',
//                        ]
//                    ]
//                ],
//                'guofubao' => [
//                    'label' => Yii::t('core_payment', '国付宝'),
//                    'sort' => 60,
//                    'fields' => [
//                        'isEnable' => [  //field
//                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
//                            'sort' => 10,
//                            'type' => 'radio',               //the input type: text, select, checkbox, radio
//                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
//                            'value' => '0',               //the default value
//                        ],
//                        'feeRate' => [
//                            'label' => Yii::t('core_payment', '充值手续费'),
//                            'sort' => 20,
//                            'type' => 'text',
//                            'value' => '',
//                        ],
//                        'merchantID' => [
//                            'label' => Yii::t('core_payment', '商户代码'),
//                            'sort' => 30,
//                            'type' => 'text',
//                            'value' => '',
//                        ],
//                        'VerficationCode' => [
//                            'label' => Yii::t('core_payment', '商户识别码'),
//                            'sort' => 30,
//                            'type' => 'password',
//                            'value' => '',
//                        ],
//                        'virCardNoIn' => [
//                            'label' => Yii::t('core_payment', '国付宝帐号'),
//                            'sort' => 30,
//                            'type' => 'text',
//                            'value' => '',
//                        ]
//                    ]
//                ],
//                'easyPay' => [
//                    'label' => Yii::t('core_payment', '易生支付'),
//                    'sort' => 70,
//                    'fields' => [
//                        'isEnable' => [  //field
//                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
//                            'sort' => 10,
//                            'type' => 'radio',               //the input type: text, select, checkbox, radio
//                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
//                            'value' => '1',               //the default value
//                        ],
//                        'feeRate' => [
//                            'label' => Yii::t('core_payment', '充值手续费'),
//                            'sort' => 20,
//                            'type' => 'text',
//                            'value' => '0.2',
//                        ],
//                        'partner' => [
//                            'label' => Yii::t('core_payment', '商户号'),
//                            'sort' => 30,
//                            'type' => 'text',
//                            'value' => '100000000001264',
//                        ],
//                        'key' => [
//                            'label' => Yii::t('core_payment', '支付密钥'),
//                            'sort' => 30,
//                            'type' => 'password',
//                            'value' => 'ada466g1d5907cg51aedb2011412f4fd50a73d4ge561d8ga5549ec0107d83457',
//                        ],
//                    ]
//                ],
//                'cmPay' => [
//                    'label' => Yii::t('core_payment', '中国移动支付'),
//                    'sort' => 80,
//                    'fields' => [
//                        'isEnable' => [  //field
//                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
//                            'sort' => 10,
//                            'type' => 'radio',               //the input type: text, select, checkbox, radio
//                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
//                            'value' => '0',               //the default value
//                        ],
//                        'feeRate' => [
//                            'label' => Yii::t('core_payment', '充值手续费'),
//                            'sort' => 20,
//                            'type' => 'text',
//                            'value' => '0.2',
//                        ],
//                        'merchantId' => [
//                            'label' => Yii::t('core_payment', '商户号'),
//                            'sort' => 30,
//                            'type' => 'text',
//                            'value' => '888009972990047',
//                        ],
//                        'serverCert' => [
//                            'label' => Yii::t('core_payment', '支付密钥'),
//                            'sort' => 30,
//                            'type' => 'password',
//                            'value' => '0IzjBZHGPg2kIrLZGrD2BkCSwrAw2djUgCcajSr2fW2pFdCEu6EoMEYYBXly34au',
//                        ],
//                    ]
//                ],
//                'chinaBankNo' => [
//                    'label' => Yii::t('core_payment', '网银积分'),
//                    'sort' => 90,
//                    'fields' => [
//                        'isEnable' => [  //field
//                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
//                            'sort' => 10,
//                            'type' => 'radio',               //the input type: text, select, checkbox, radio
//                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
//                            'value' => '0',               //the default value
//                        ],
//                        'feeRate' => [
//                            'label' => Yii::t('core_payment', '充值手续费'),
//                            'sort' => 20,
//                            'type' => 'text',
//                            'value' => '0.2',
//                        ],
//                        'merchantId' => [
//                            'label' => Yii::t('core_payment', '商户号'),
//                            'sort' => 30,
//                            'type' => 'text',
//                            'value' => '22946993',
//                        ],
//                        'mkey' => [
//                            'label' => Yii::t('core_payment', '支付密钥'),
//                            'sort' => 30,
//                            'type' => 'password',
//                            'value' => '285279781@qq.comronxindai2014',
//                        ],
//                    ]
//                ],
//                'ecpssNo' => [
//                    'label' => Yii::t('core_payment', '汇潮积分'),
//                    'sort' => 100,
//                    'fields' => [
//                        'isEnable' => [  //field
//                            'label' => Yii::t('core_payment', '是否启用'),      //the label for input
//                            'sort' => 10,
//                            'type' => 'radio',               //the input type: text, select, checkbox, radio
//                            'data' => ['1' => Yii::t('core_payment', '是'), '0' => Yii::t('core_payment', '否')],
//                            'value' => '0',               //the default value
//                        ],
//                        'feeRate' => [
//                            'label' => Yii::t('core_payment', '充值手续费'),
//                            'sort' => 20,
//                            'type' => 'text',
//                            'value' => '0.2',
//                        ],
//                        'merchantId' => [
//                            'label' => Yii::t('core_payment', '商户号'),
//                            'sort' => 30,
//                            'type' => 'text',
//                            'value' => '19772',
//                        ],
//                        'mkey' => [
//                            'label' => Yii::t('core_payment', '支付密钥'),
//                            'sort' => 30,
//                            'type' => 'password',
//                            'value' => 'NvW}wt[k',
//                        ],
//                    ]
//                ],
            ]
        ],
    ],
];