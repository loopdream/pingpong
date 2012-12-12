<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phaxio
{
	private $debug = false;
    private $api_key = null;
    private $api_secret = null;
    private $host = null;
	public $ci = null;
	
	   public function __construct() {
			$this->ci =& get_instance();
	        $this->api_key = $this->ci->config->item('phaxio_key');
	        $this->api_secret = $this->ci->config->item('phaxio_secret');
			$this->host = $this->ci->config->item('phaxio_base');
	    }

	    public function faxStatus($faxId) {
	        if (!$faxId) throw new PhaxioException("You must include a fax id. ");

	        $params = array('id' => $faxId);

	        $result = $this->doRequest($this->host . "faxStatus", $params);
	        return $result;
	    }

	    public function sendFax($to, $filenames = array(), $options = array()) {
	        if (!is_array($filenames)) $filenames = array($filenames);

	        if (!$to)
	            throw new PhaxioException("You must include a 'to' number. ");
	        else if (count($filenames) == 0 && !$options['string_data'])
	            throw new PhaxioException("You must include a file to send.");

	        $params = array();

	        //setup the to parameter
	        $to = (is_array($to) ? $to : array($to));
	        $i = 0;
	        foreach ($to as $toNumber) {
	            $params["to[$i]"] = $toNumber;
	            $i++;
	        }

	        $i = 0;
	        foreach ($filenames as $filename) {
	            if (!file_exists($filename)) {
	                throw new PhaxioException("The file '$filename' does not exist.");
	            }
	            $params["filename[$i]"] = "@$filename";
	            $i++;
	        }


	        $this->paramsCopy(array(
	            'string_data', 'string_data_type', 'batch', 'batch_delay', 'callback_url'
	        ), $options, $params);

	        $result = $this->doRequest($this->host . "send", $params);
	        return $result;
	    }

		public function attachPhaxcode($filenames = array(), $options = array())
		{
			if (!is_array($filenames)) $filenames = array($filenames);

	        else if (count($filenames) == 0 && !$options['string_data'])
	            throw new PhaxioException("You must include a file to send.");

	        $params = array();

	        $i = 0;
	        foreach ($filenames as $filename) {
	            if (!file_exists($filename)) {
	                throw new PhaxioException("The file '$filename' does not exist.");
	            }
	            $params["filename[$i]"] = "@$filename";
	            $i++;
	        }

	        $this->paramsCopy(array('x', 'y', 'metadata', 'page_number'), $options, $params);
	
	        $params['api_key'] = $this->getApiKey();
	        $params['api_secret'] = $this->getApiSecret();
	
			$response = $this->curlPost($this->host . "attachPhaxCodeToPdf", $params, false);
			
			$result = new PhaxioOperationResult(true, '', array('file' => $response));
	        return $result;

		}

	    public function fireBatch($batchId) {
	        if (!$batchId)
	            throw new PhaxioException("You must provide a batchId.");
	        $params = array('id' => $batchId);
	        $result = $this->doRequest($this->host . "fireBatch", $params);
	        return $result;
	    }

	    public function closeBatch($batchId) {
	        if (!$batchId)
	            throw new PhaxioException("You must provide a batchId.");
	        $params = array('id' => $batchId);
	        $result = $this->doRequest($this->host . "closeBatch", $params);
	        return $result;
	    }

	    public function getApiKey() {
	        return $this->api_key;
	    }

	    public function getApiSecret() {
	        return $this->api_secret;
	    }

	    private function doRequest($address, $params, $wrapInPhaxioOperationResult = true) {
	        $ch = curl_init($address);

	        $params['api_key'] = $this->getApiKey();
	        $params['api_secret'] = $this->getApiSecret();

	        if ($this->debug){
	            echo "Request address: \n\n $address?" . http_build_query($params) . "\n\n";
	        }

	        $result = $this->curlPost($address, $params, false);

	        if ($this->debug){
	            echo "Response: \n\n";
	            var_dump($result);
	            echo "\n\n";
	        }

	        if ($wrapInPhaxioOperationResult){
	            $result = json_decode($result, true);

	            if (!$result){
	                $opResult = new PhaxioOperationResult(false, "No data received from service.");
	            }
	            else {
	                $opResult = new PhaxioOperationResult($result['success'], $result['message'], $result['data']);
	            }
	            return $opResult;
	        }
	        else {
	            return $result;
	        }
	    }

	    private function curlPost($host, $params = array(), $async = false){
		
	        $handle = curl_init($host);
	        curl_setopt($handle, CURLOPT_POST, true);

			//fixing SSL error?  Just don't check...
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);

	        if ($async){
	            curl_setopt($handle, CURLOPT_TIMEOUT, 1);
	        }
	        else {
	            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	        }

	        $this->curl_setopt_custom_postfields($handle, $params);
	        $result = curl_exec($handle);

	        if($result === false)
	            throw new Exception('Curl error: ' . curl_error($handle));

	        return $result;
	    }

	    private function paramsCopy($names, $options, &$params){
	        foreach($names as $name)
	            if (isset($options[$name])) $params[$name] = $options[$name];
	    }

	    private function curl_setopt_custom_postfields($ch, $postfields, $headers = null) {
	        $algos = hash_algos();
	        $hashAlgo = null;
	        foreach (array('sha1', 'md5') as $preferred) {
	            if (in_array($preferred, $algos)) {
	                $hashAlgo = $preferred;
	                break;
	            }
	        }
	        if ($hashAlgo === null) {
	            list($hashAlgo) = $algos;
	        }
	        $boundary =
	                '----------------------------' .
	                substr(hash($hashAlgo, 'cURL-php-multiple-value-same-key-support' . microtime()), 0, 12);

	        $body = array();
	        $crlf = "\r\n";
	        $fields = array();
	        foreach ($postfields as $key => $value) {
	            if (is_array($value)) {
	                foreach ($value as $v) {
	                    $fields[] = array($key, $v);
	                }
	            } else {
	                $fields[] = array($key, $value);
	            }
	        }
	        foreach ($fields as $field) {
	            list($key, $value) = $field;
	            if (strpos($value, '@') === 0) {
	                preg_match('/^@(.*?)$/', $value, $matches);
	                list($dummy, $filename) = $matches;
	                $body[] = '--' . $boundary;
	                $body[] = 'Content-Disposition: form-data; name="' . $key . '"; filename="' . basename($filename) . '"';
	                $body[] = 'Content-Type: application/octet-stream';
	                $body[] = '';
	                $body[] = file_get_contents($filename);
	            } else {
	                $body[] = '--' . $boundary;
	                $body[] = 'Content-Disposition: form-data; name="' . $key . '"';
	                $body[] = '';
	                $body[] = $value;
	            }
	        }
	        $body[] = '--' . $boundary . '--';
	        $body[] = '';
	        $contentType = 'multipart/form-data; boundary=' . $boundary;
	        $content = join($crlf, $body);
	        $contentLength = strlen($content);

	        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            'Content-Length: ' . $contentLength,
	            'Expect: 100-continue',
	            'Content-Type: ' . $contentType,
	        ));

	        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
	    }


	}

	class PhaxioException extends Exception {}

	class PhaxioOperationResult {

	    private $message = null;
	    private $success = false;
	    private $data = null;

	    public function __construct($success, $message = null, $data = null){
	        $this->success = $success;
	        $this->message = $message;

	        if ($data != null){
	            $this->data = $data;
	        }

	    }

	    public function succeeded() {
	        return $this->success;
	    }

	    public function getData($key = null) {
			if($key == NULL)
			{
	        	return $this->data;				
			}
			elseif(array_key_exists($key, $this->data))
			{
				return $this->data[$key];
			}
			else
			{
				return false;
			}
	    }

	    public function getMessage() {
	        return $this->message;
	    }

	}