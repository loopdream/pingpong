<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


switch ($_SERVER['HTTP_HOST']) {
	case 'local.makeday.setr.co.uk':
		$config['twitter_consumer_token']	= 'VkhHQ2kBNsRyScy01gCxw';
		$config['twitter_consumer_secret']	= 'y6JylYwy7TvW2SQxHBxR72qsCRxFiQPubxtr1pjo';
		$config['twitter_access_token']		= '1008578234-QwV6xS7irkKnIh7jq8Y4jlZXO6yPAwfs0xIyAG1';
		$config['twitter_access_secret']	= 'ivyLGMssm8ScrpP1pElE1J3hk0QfuhzvM17j3ikLmKg';
		break;

	case 'makeday.setr.co.uk':
		$config['twitter_consumer_token']	= 'OHLsymkMQSJAYmN2LFwi3g';
		$config['twitter_consumer_secret']	= 'aHUysw3wP6TUnzpHWAOMJHUGmYHPPvceC2jVdWEpLVg';
		$config['twitter_access_token']		= '1008578234-p4OvcKN949XkbiY2pSkg5ho3J0w6UhOmGpUpPtm';
		$config['twitter_access_secret']	= 'Ra2CXjNJZgFk9jOMl23PJeZ7fwAA958hDZNIZeTw';
		break;
}
