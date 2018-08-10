<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Npts extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('task_model'); 
    }
    

    // Connect API
    // function netbayApi_getShipment($hwb = '') {
    //     $shipmentinfo = $this->updateDb($hwb);
    //     if(!empty($shipmentinfo)) {
    //         print_r(json_encode($shipmentinfo));
    //     } else {
    //         print_r(json_encode(array()));
    //     }
        
    // }



    // function updateDb($hwb) {
    //     $query = $this->db->get_where('netbay_import', array('hawb' => $hwb));
    //     if(!empty($query->result())) {
    //         return ($query->result()[0]);
    //     } else {
    //         $data = $this->getShipmentFormNbApi($hwb);
    //         if(empty($data)) {
    //             return (Object)array();
    //         } else 
    //             $data['cat'] = 'Formal';

    //             // $this->db->where('hawb', $hwb);
    //             $this->db->set($data); 
    //             $this->db->insert('netbay_import'); 

    //             return ((Object)$data); 
    //     }
    // }

    function getShipmentFormNptsApi($hwb = '') {
        $url = 'http://npts2.apis.dhl.com:6010/npts/ShipmentDataFetchServlet?action=14';

        $params = array(
        	'querycriteria' => 'QUERY_BY_AWB',
        	'queryData' => $hwb,
        	'helpPageId' => 'WF03',
        	);


        $resp = $this->postCURL($url,$params);

        if (strpos($resp, 'NPTS Error')) {
		    echo 'No AWB';
		    return true;
		} else

		$startpos = strpos($resp,"<form");
		$second_level = (substr($resp, $startpos));
		$length = strlen($second_level);

		$needle = "<table";
		$lastPos = 0;
		$positions = array();

		while (($lastPos = strpos($second_level, $needle, $lastPos))!== false) {
		    $positions[] = $lastPos;
		    $lastPos = $lastPos + strlen($needle);
		}

		$arr_tables = array();
		foreach ($positions as $key => $value) {
			if($key >= sizeof($positions)-1) {
				$arr_tables[] = substr($second_level,$positions[$key]);
			} else
				$arr_tables[] = substr($second_level,$positions[$key],$positions[$key+1]-$length);
		}

		// detail 1 - table2
		$detail_1 = $arr_tables[2];
		$detail_1_length = strlen($detail_1);
		$detail_1_needle = '<td class="whiteTdNormal "';
		$detail_1_lastPos = 0;
		$detail_1_positions = array();

		while (($detail_1_lastPos = strpos($detail_1, $detail_1_needle, $detail_1_lastPos))!== false) {
		    $detail_1_positions[] = $detail_1_lastPos;
		    $detail_1_lastPos = $detail_1_lastPos + strlen($detail_1_needle);
		}

		$detail_1_arr_tables = array();
		$i = 0;
		foreach ($detail_1_positions as $key => $value) {
			if($key >= sizeof($detail_1_positions)-1) {
				$detail_1_arr_tables[$i] = strip_tags(str_replace("&nbsp;", '',substr($detail_1,$detail_1_positions[$key])));
			} else {
				$detail_1_arr_tables[$i] = strip_tags(str_replace("&nbsp;", '', substr($detail_1,$detail_1_positions[$key],$detail_1_positions[$key+1]-$detail_1_length)));
			}
			$i++;
		}

		// detail 2 - table3
		$detail_2 = $arr_tables[3];
		$detail_2_length = strlen($detail_2);
		$detail_2_needle = '<td class="whiteTdNormal "';
		$detail_2_lastPos = 0;
		$detail_2_positions = array();

		while (($detail_2_lastPos = strpos($detail_2, $detail_2_needle, $detail_2_lastPos))!== false) {
		    $detail_2_positions[] = $detail_2_lastPos;
		    $detail_2_lastPos = $detail_2_lastPos + strlen($detail_2_needle);
		}

		$detail_2_arr_tables = array();

		foreach ($detail_2_positions as $key => $value) {
			if($key >= sizeof($detail_2_positions)-1) {
				$detail_2_arr_tables[] = strip_tags(str_replace("&nbsp;", '',substr($detail_2,$detail_2_positions[$key])));
			} else {
				$detail_2_arr_tables[] = strip_tags(str_replace("&nbsp;", '', substr($detail_2,$detail_2_positions[$key],$detail_2_positions[$key+1]-$detail_2_length)));
			}
		}

		// print_r($detail_2_arr_tables);

		// detail 3 - table4
		$detail_3 = $arr_tables[4];
		$detail_3_length = strlen($detail_3);
		$detail_3_needle = '<td class="whiteTdNormal "';
		$detail_3_lastPos = 0;
		$detail_3_positions = array();

		while (($detail_3_lastPos = strpos($detail_3, $detail_3_needle, $detail_3_lastPos))!== false) {
		    $detail_3_positions[] = $detail_3_lastPos;
		    $detail_3_lastPos = $detail_3_lastPos + strlen($detail_3_needle);
		}

		$detail_3_arr_tables = array();

		foreach ($detail_3_positions as $key => $value) {
			if($key >= sizeof($detail_3_positions)-1) {
				$detail_3_arr_tables[] = strip_tags(str_replace("&nbsp;", '',substr($detail_3,$detail_3_positions[$key])));
			} else {
				$detail_3_arr_tables[] = strip_tags(str_replace("&nbsp;", '', substr($detail_3,$detail_3_positions[$key],$detail_3_positions[$key+1]-$detail_3_length)));
			}
		}

		// print_r($detail_2_arr_tables);


		// detail 4 - table10
		$detail_4 = $arr_tables[10];
		$detail_4_length = strlen($detail_4);
		$detail_4_needle = '<td class="grayTdNormal"';
		$detail_4_lastPos = 0;
		$detail_4_positions = array();

		while (($detail_4_lastPos = strpos($detail_4, $detail_4_needle, $detail_4_lastPos))!== false) {
		    $detail_4_positions[] = $detail_4_lastPos;
		    $detail_4_lastPos = $detail_4_lastPos + strlen($detail_4_needle);
		}

		$detail_4_arr_tables = array();

		foreach ($detail_4_positions as $key => $value) {
			if($key >= sizeof($detail_4_positions)-1) {
				$detail_4_arr_tables[] = strip_tags(str_replace("&nbsp;", '',substr($detail_4,$detail_4_positions[$key])));
			} else {
				$detail_4_arr_tables[] = strip_tags(str_replace("&nbsp;", '', substr($detail_4,$detail_4_positions[$key],$detail_4_positions[$key+1]-$detail_4_length)));
			}
		}

		// print_r($detail_4_arr_tables);

		$mapping_arr = array(
			'shipment'=> array(
				'details' => $detail_1_arr_tables[0],
				'orig'=> $detail_1_arr_tables[1],
				'location'=> $detail_1_arr_tables[2],
				'dest'=> $detail_1_arr_tables[3],
				'pcs'=> $detail_1_arr_tables[4],
				'weight'=> $detail_1_arr_tables[5],
				'volumetricweight'=> $detail_1_arr_tables[6],
				'datetime'=> $detail_1_arr_tables[7],
				'route'=> $detail_1_arr_tables[8],
				'postcode'=> $detail_1_arr_tables[9],
				'product'=> $detail_1_arr_tables[10],
				'amount'=> $detail_1_arr_tables[11],
				'duplicate'=> $detail_1_arr_tables[12],
				),

			'shipper'=> array(
				'shipper'=> $detail_2_arr_tables[0],
				'shipperref'=> $detail_2_arr_tables[1],
				'account'=> $detail_2_arr_tables[2],
				'tel'=> $detail_2_arr_tables[3],
				'address'=> $detail_2_arr_tables[4],
				'payeracc'=> $detail_2_arr_tables[5]
				),
			'consignee'=> array(
				'consignee'=> $detail_3_arr_tables[0],
				'account'=> $detail_3_arr_tables[1],
				'tel'=> $detail_3_arr_tables[2],
				'address'=> $detail_3_arr_tables[3],
				),
			'status'=> array(
				'no_of_checkpoints'=> $detail_4_arr_tables[0],
				'last_checkpoint'=> $detail_4_arr_tables[4],
				),

			);
		$json_result = json_encode($mapping_arr);
		print_r(str_replace('\r\n', '',$json_result));


    }

    // function curlApt($url = '') {
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_RETURNTRANSFER => 1,
    //         CURLOPT_URL => $url,
    //         CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    //     ));
    //     $resp = curl_exec($curl);
    //     curl_close($curl);

    //     return $resp;
    // }

    public function postCURL($_url, $_param){

        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v) 
        { 
          $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

        $output=curl_exec($ch);

        curl_close($ch);

        return $output;
    }

}

?>