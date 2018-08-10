<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Netbay extends BaseController
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
    function netbayApi_getShipment($hwb = '') {
        $shipmentinfo = $this->updateDb($hwb);
        if(!empty($shipmentinfo)) {
            print_r(json_encode($shipmentinfo));
        } else {
            print_r(json_encode(array()));
        }
        
    }



    function updateDb($hwb) {
        $query = $this->db->get_where('netbay_import', array('hawb' => $hwb));
        if(!empty($query->result())) {
            return ($query->result()[0]);
        } else {
            $data = $this->getShipmentFormNbApi($hwb);
            if(empty($data)) {
                return (Object)array();
            } else 
                $data['cat'] = 'Formal';

                // $this->db->where('hawb', $hwb);
                $this->db->set($data); 
                $this->db->insert('netbay_import'); 

                return ((Object)$data); 
        }
    }

    function getShipmentFormNbApi($hwb = '') {
        $url = 'http://23.168.85.150:8081/netbayconnect/index.php/api/getShipment/'.$hwb;
        $resp = $this->curlApt($url);

        $arr_data = json_decode($resp);

        if(!empty($arr_data)) {

            $mapping = array(
                'netbay_id'  => $arr_data[0]->ImDclCtrl,
                'hawb'  => $arr_data[0]->houseBillOfLanding,
                'vessel'  => $arr_data[0]->vesselName,
                'mawb'  => $arr_data[0]->masterBillOfLanding,
                'arrivalDate'  => $arr_data[0]->arrivalDate,
                'declarationRef'    =>  $arr_data[0]->referenceNo,
                'declarationDate'   =>  $arr_data[0]->referenceDate,
                'company_name_e'    =>  $arr_data[0]->companyEnglishName,
                'company_address_e'    =>  $arr_data[0]->streetAndNumber ." ".$arr_data[0]->subProvince." ".$arr_data[0]->province." ".$arr_data[0]->postCode,
                'company_detail1'    =>  $arr_data[0]->companyDetail1,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,
                // 'declarationRef'    =>  $arr_data[0]->referenceNo,

            );

            // print_r($mapping);
            // print_r($arr_data[0]);
            return $mapping;
        } else 
            return array();
    }

    function curlApt($url = '') {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }

}

?>