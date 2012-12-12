# About CloudComm
CloudComm provides simple access to cloud-based communication services.  Currently, this includes Twilio (SMS, Voice) and Phaxio (fax).

## Twilio
The Twilio library is based off Ben Edmunds's codeigniter library (which is based of Twilio's PHP helper).  

### Example
	//load spark
	$this->load->spark('cloudcomm/0.2.0');
	
	//load twilio
	$this->load->library('twilio');
	
	//Send SMS
	$response = $this->twilio->sms('from', 'to', 'hello, this is a test');

## Phaxio
Phaxio is a developer-friendly faxing service.  This library is based off Phaxio's PHP helper.

### Example
	//load spark
	$this->load->spark('cloudcomm/0.2.0');
	
	//load phaxio
	$this->load->library('phaxio');
	
	//Send a fax from string
	$string = "<h1>Hello, this is a test fax</h1>";
	$result = $this->phaxio->sendFax('to', array(), array('string_data' => $string, 'string_data_type' => 'html'));
	
	if($result->succeeded())
	{
		echo('Fax successfully sent! ');
 		$faxId = $result->getData('faxId');
		echo('FaxId: ' . $faxId);
	}
	else
	{
		echo('Error: ' . $result->getMessage());
	}

### Example (2)
	//load spark
	$this->load->spark('cloudcomm/0.2.0');
	
	//load phaxio
	$this->load->library('phaxio');
	
	//Specify phaxcode options
	$options = array(
		"x" => "10",
		"y" => "10",
		"metadata" => 'This is metadata',
		"page_number" => "1"
		);

	//Attach Phaxcode to document		
	$result = $this->phaxio->attachPhaxcode('path/to/pdf', $options);

## Moonshado
Moonshado is a SMS gateway.  This simple library allows you to send SMS messages as noted in the example below.  The response variable returns the XML string from the Moonshado server.

### Example
	//load spark
	$this->load->spark('cloudcomm/0.2.0');
	
	//load twilio
	$this->load->library('moonshado');
	
	//Send SMS
	$response = $this->moonshado->sms('to', 'hello, this is a test');