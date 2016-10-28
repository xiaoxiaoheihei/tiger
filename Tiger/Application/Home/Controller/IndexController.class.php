<?php

namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        $this->display('index');
    }

    /**
     * 模糊查询匹配房子地址
     * @return [json]  [$array]
     */
    public function getaddress(){
		
    	$address = I('get.address'); 

    	$str=explode(",",$address);

		$strnum = count ($str);

		$address =preg_replace("/\s(?=\s)/","\\1",$str['0']); 

		$address = ucwords($address);

		$suburb = 'xxx' ; 

		$city = $address ;  

		if ($strnum>2) {	

				 $sub = preg_replace("/\s(?=\s)/","\\1",$str['1']); 

				 $cit = preg_replace("/\s(?=\s)/","\\1",$str['2']); 

				 $suburb = ucwords($sub); 	

				 $city = ucwords($cit);	

		}else if ($strnum>1) {

				 $city = 'xxx';

				 $sub = preg_replace("/\s(?=\s)/","\\1",$str['1']); 

				 $suburb = ucwords($sub); 
		}
		
		
		//判断是否有值
		if($address||$suburb||$city){

			//链接远程服务器
			$cont = new \Think\Model\MongoModel("House_general");

			//链接成功
			//模糊搜索
			if($cont){

					$regex = new \MongoRegex("/".$address."/");

					$where =  array('address' => $regex,);

					$cursor = $cont->where($where)->field(array("address"=>true,"suburb"=>true,"city"=>true))->limit("10")->select();

				if(empty($cursor)){

					$regex = new \MongoRegex("/".$suburb."/");

					$where =  array('suburb' => $regex,);

					$cursor = $cont->where($where)->field(array("address"=>true,"suburb"=>true,"city"=>true))->limit("10")->select();

					if(empty($cursor)){

						$new_array = substr($address.$suburb.$city, 0,6);

						$regex = new \MongoRegex("/".$new_array."/");

						$where =  array('address' => $regex,);

						$cursor = $cont->where($where)->field(array("address"=>true,"suburb"=>true,"city"=>true))->limit("10")->select();

					}else{

						return false;
					}
				}

					$array=array();

					foreach ($cursor as $id => $value) {

								$array[]=$value;
							}
	
					if ($array) {

							echo json_encode($array);

						}else{

							return false;

						}
				//链接失败
			}else{

				return false;

			}	
			//如果为空返回错误信息
		}else{

			return false;

		}
    }

   /**
    * 查询单个房屋所有信息
    * @return [json]  [$array]
    */
    public function getaddinfo(){

    	$id = I('get.id');

		if ($id) {

			$cont = new \Think\Model\MongoModel("House_general");

			if ($cont) {

				$array=array();

				$where = array('_id' =>new \MongoId("$id"));

				$cursor = $cont->where($where)->select();

				$array=array();

				foreach ($cursor as $id => $value) {

					$array[]=$value;

				}

				echo  json_encode($array);die;

						}
		} else {

			echo "error . not find object ";

		}

    }


    /**
     * 返回学校详情
     * @return [json] [$array]
     */
    public function getschoolzone(){

    	$id = I('get.id');

    	if ($id) {

			$cont = new \Think\Model\MongoModel("School_detail");

			if ($cont) {

				$array=array();

				$where = array('_id' =>new \MongoId("$id"));

				$cursor = $cont->where($where)->select();

				$array=array();


				foreach ($cursor as $id ) {

					foreach ($id as $key => $value) {

						$array[]=$value;

					}

				}

				echo  json_encode($array);die;

						}
		} else {

			echo "error . not find object ";

		}

    }

}