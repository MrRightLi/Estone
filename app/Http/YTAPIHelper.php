<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/8/8
 * Time: 11:06
 */

namespace App\Http;

class YTAPIHelper
{
    const URL = 'http://124.89.119.82:18080/webservice/services/SvcService?wsdl';

    private $clinet;

    public function __construct()
    {
        $this->clinet = new \SoapClient(self::URL);
    }

    /** 卡资料查询
     * @param $card_num 卡号
     * @return mixed
     */
    public function cardInfoQuery($card_num)
    {
        header("content-type:text/html;charset=utf-8");
        try {
            // 1589580299000460292
            $param = array(
                'pan' => $card_num,
                'txnId' => '50',
            );

            $result = $this->clinet->transX(array('in0' => $param));

            //将stdclass object的$result转换为array
            $result = get_object_vars($result);
            //输出结果
            $out = $result['out'];

            if ($out->rc == '00') {
                $response = array(
                    'balAmt' => $out->balAmt * 100, // 可用余额
                    'cardStatus' => $out->cardStatus, // 卡状态
                    //'custAddr' => $out->custAddr,
                    //'custName' => $out->custName, // 持卡人姓名
                    //'custNo' => $out->custNo, // 证件号码
                    //'cvn2' => $out->cvn2,
                    //'openDate' => $out->openDate, // 生效期
                    //'expdate' => $out->expDate, // 失效期
                    //'rcDetail' => $out->rcDetail, // 返回码解释
                    //'noPinAmtDay' => $out->noPinAmtDay, // 当日累计交易小额免密额度
                    //'noPinAmt' => $out->noPinAmt // 单笔交易小额免密额度
                );

                return $this->ajaxReturnSuccess($response);
            } else {
                return $this->ajaxReturnError('账号或密码错误');
            }
        } catch (\SOAPFault $e) {
            print $e;
        }
    }

    /** 密码明文加密
     * @param $card_no 卡号
     * @param $password 明文密码
     * @return string
     */
    public function requestEncryptPassword($card_no,$password) {
        $txnId = 'W505';
        $param = array(
            'txnId' => $txnId,
            'pan' => $card_no,
            'pinData' => $password
        );
        $result = $this->clinet->transX(array('in0' => $param));

        $result = get_object_vars($result);
        $out = $result['out'];

        if ($out->rc == '00') {
            $response = array(
                'pan' => $out->pan,
                'pinData' => $out->pinData,
            );
            return $this->ajaxReturnSuccess($response);
        } else {
            $msg = isset($out->rcDetail) ? $out->rcDetail : '数据故障';
            return $this->ajaxReturnError($msg);
        }
    }

    /** 验证密码
     * @param $card_no
     * @param $password 密码密文
     * @return string
     */
    public function verifyPassword ($card_no,$password) {
        $txnId = 'W50';
        $param = array(
            'txnId' => $txnId,
            'pan' => $card_no,
            'pinData' => $password
        );
        $result = $this->clinet->transX(array('in0' => $param));

        $result = get_object_vars($result);
        $out = $result['out'];

        if ($out->rc == '00') {
            $response = array(
                'pan' => $out->pan,
                'rcDetail' => $out->rcDetail,
            );
            return $this->ajaxReturnSuccess($response);
        } else {
//            $response = array(
//                'pan' => $out->pan,
//                'rcDetail' => $out->rcDetail,
//            );
//            return $this->ajaxReturnSuccess($response);

            return $this->ajaxReturnError($out->rcDetail);
        }
    }

    /** 卡交易记录查询
     * @param $card_no
     * @param $start_date
     * @param $end_date
     * @return string
     */
    public function cardTransationRecord($card_no, $start_date, $end_date) {
        $param = array(
            'pan' => $card_no,
            'txnDate1' => $start_date,
            'txnDate2' => $end_date
        );
        $result = $this->clinet->searchTrans(array('in0' => $param));

        $result = get_object_vars($result);
        $out = $result['out'];
        if ($out->rc == '00') {
            $trans = $out->trans->Trans;
            return $this->ajaxReturnSuccess($trans);
        } else {
            return $this->ajaxReturnError('E400');
        }
    }

    /**
     * @param $card_no 卡号
     * @param $password 密码(密文)
     * @param $trAmt 消费金额
     * @param $mid 商户号
     * @param $tid 终端号
     * @param $order_id 订单号
     * @return mixed
     */
    public function payOrder($card_no, $password, $trAmt, $mid, $tid, $order_id) {
        \Log::info('payOrder-Model-param', ['$card_no' => $card_no,'$password' => $password, '$trAmt' => $trAmt, '$mid' => $mid, '$tid' => $tid, '$order_id' => $order_id]);
        $txnId = '2';
        $param = array(
            'txnId' => $txnId,
            'pan' => $card_no,
            'pinData' => $password,
            'trAmt' => $trAmt / 100,
            'mid' => $mid, //'898610173210046',
            'tid' => $tid, //'00000001',
            'voucher' => $order_id
        );
        $result = $this->clinet->transX(array('in0' => $param));

        $result = get_object_vars($result);

        $out = $result['out'];
        \Log::info('payOrder--request', array('out' => $out));
        return $out;
    }

    /** 退款
     * @param $card_no 卡号
     * @param $trAmt 金额(分)
     * @param $mid 商户号
     * @param $tid 终端号
     * @param $rrn 原交易参考号码
     * @return mixed
     */
    public function refound($card_no, $trAmt, $mid, $tid, $rrn) {
        \Log::info('refound-YT-param', ['card_no'=>$card_no, 'trAmt'=>$trAmt,'mid'=>$mid,'tid'=>$tid,'rrn'=>$rrn]);
        $txnId = '4';
        $param = array(
            'txnId' => $txnId,
            'pan' => $card_no,
            'trAmt' => $trAmt / 100,
            'mid' => $mid,
            'tid' => $tid,
            'rrn' => isset($rrn) ? $rrn : '0'
        );

        $result = $this->clinet->transX(array('in0' => $param));

        $result = get_object_vars($result);

        $out = $result['out'];
        \Log::info('refound--reponse', array('out' => $out));
        return $out;
    }

    /** 充值
     * @param $trAmt
     * @param $card_no
     * @return mixed
     */
    public function reCharge($trAmt,$card_no) {
        \Log::info('reCharge-YT-param', ['trAmt'=>$trAmt,'card_no'=>$card_no]);
        $txnId = '20';
        $param = array(
            'txnId' => $txnId,
            'trAmt' => $trAmt,
            'rsvdcFlag' => 1,
            'pan' => $card_no
        );

        $result = $this->clinet->transX(array('in0' => $param));

        $result = get_object_vars($result);

        $out = $result['out'];
        \Log::info('reCharge--reponse', array('out' => $out));
        return $out;

    }

    #program mark -- helper
    public function ajaxReturnSuccess($param) {
        $return = array(
            'data' => $param,
            'status' => 'success',
            'msg' => ''
        );

        return json_encode($return);
    }

    public function ajaxReturnError($code) {
        $return = array(
            'data' => '',
            'status' => 'fail',
            'msg' => $code
        );

        return json_encode($return);
    }

    /** 验签
     * @param $sign
     * @param $param
     * @return bool
     */
    public function checkSign($sign, $param) {
        $sign_string = '';
        foreach ($param as $value) {
            $sign_string = $sign_string.$value;
        }

        if ($sign === md5($sign_string)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @param int $json_option 传递给json_encode的option参数
     * @return void
     */
    protected function ajaxReturn($data,$type='',$json_option=0) {
        header('Content-Type:application/json; charset=utf-8');
        if(empty($type)) $type  =   C('DEFAULT_AJAX_RETURN');
        switch (strtoupper($type)){
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                exit(json_encode($data,$json_option));
            case 'XML'  :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler  =   isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                exit($handler.'('.json_encode($data,$json_option).');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
            default     :
                // 用于扩展其他返回格式数据
                Hook::listen('ajax_return',$data);
        }
    }
}