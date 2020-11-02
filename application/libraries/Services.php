<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Services{
	public function __construct()
    {
        // Get the CodeIgniter reference
        $this->_CI = &get_instance();

        // Load the BRIInterfaceNG Library
        $this->_CI->load->library("Soap", "soap");

    }

    public function WsdlServices($param,$method,$url,$header=null)
    {   
        try {

            $client = new nusoap_client($url, 'wsdl');
            if ($header != null) {
                // print_r($header);exit();
                $client->setHeaders($header);
               // $client = $this->setHeaders($client);
            }
            // print_r($header);exit;
            // print_r($this->test_connection());exit();
            try{

                $result = $client->call($method, array($param));
                // echo '<h2>Request</h2>';
                // echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
                // // echo '<h2>Response</h2>';
                // // echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
                echo '<h2>Debug</h2>';
                echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
                exit();
                return $result;

            }
            catch(Exception $e){
                return $e->getMessage();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

    
    }

    function restServices($param,$method,$url,$headers = null)
    {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            if ($method == 'POST') {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$param);  
            }elseif ($method == 'PUT') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS,$param);  
                
            }

            if ($headers == null) {
                $headers = array(
                        'Content-Type: application/json'
                    );
            };

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $response = strip_tags(curl_exec($ch));
            curl_close($ch);


            $result = json_decode($response);
     
            return $result;
    }
}
?>