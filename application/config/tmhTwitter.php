<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


switch (ENVIRONMENT) {
	case 'local':
	case 'testing':
		$config['twitter_consumer_token']		= 'lQLj43FPZ1gzsu9UxWvHGw';
		$config['twitter_consumer_secret']		= 'VJjdf1DPGzPMCrMsXtXfOoWFBLkiRWAb0kgUo75piNQ';
		$config['twitter_access_token']			= '899690029-3hMGjKb3kQXcZqXs7uRXgvcJaB8m60x65lZJqh4A';
		$config['twitter_access_secret']		= '3xM9rb0wYv4byOICy8kYEKvlmE6eOhE9U2DEv3nhh8';

		// this is the second tweet account for the hourly tweet - currently it's @gettybot
		$config['twitter_access_token2']		= '817096818-JkAnwWXxgXqTgzQcmUWLbX8hoSpkuHtYVrbgMK0f';
		$config['twitter_access_secret2']		= 'FLkg6bqSylzvlS3c6gRQlGiA5tZnwc1EQMb8Ybspn8';
		break;
	case 'development':
		$config['twitter_consumer_token']		= 'YKmv2WBM8jiB5A90IbrCw';
		$config['twitter_consumer_secret']		= '3OtGkhhg2hHi40mHvcOyUC5fLuTziQK8ba0WnmJi8yM';
		$config['twitter_access_token']			= '899690252-p4UTqa9D9d7wTYhh0IS2d2rUpC6WD2MF2nCB5yWe';
		$config['twitter_access_secret']		= 'NjX5gh9Ux5hPo465DOGeX70rcBIOFa2yw8ZGIvCDEKA';

		// this is the second tweet account for the hourly tweet - currently it's @gettybot
		$config['twitter_access_token2']		= '817096818-XIRBsZiFHVZgBp20WRtwcPFn75mGA7LafrF88WgO';
		$config['twitter_access_secret2']		= 'URQnxdpKMU0jCqpvvSGCdpwG4n3UHZTJBVogyEU4SQ';
		break;
	case 'production':
		//@gettybot
		//$config['twitter_consumer_token']		= 'XMeTx1Ds14pnvrSHllNBdg';
		//$config['twitter_consumer_secret']		= 'BAIm9t0JJDqXGvPY9vc66H0vMV90pVCgHrYA2Ilwxo';
		//$config['twitter_access_token']			= '817096818-oNxa8m7NmFErnQrYcNDl0FcDhXKbqWpQAxuX138Y';
		//$config['twitter_access_secret']		= '2Bklm7e1izziYvbt2Xie18gw82gwUGsUVZX8Pbg';

		//@FeedMeGetty
		//the feed by getty images
		$config['twitter_consumer_token']		= 'w8rXiTJC0i6gCvzNcdsmA';
		$config['twitter_consumer_secret']		= '7wdXoLTMZqKzAECRAxTYv9ZCqSl7uURMZeEmljog';
		$config['twitter_access_token']			= '943579417-CDFSWUV3WnXTvZE4oxVZ0fq2CNuuBN4GMBqlAXEp';
		$config['twitter_access_secret']		= '4UhaUpkhMOWWyh5p06EBmvOLezKtQa70rwWeOodFOBs';

		// this is the second tweet account for the hourly tweet - currently it's @gettybot
		$config['twitter_access_token2']		= '817096818-oNxa8m7NmFErnQrYcNDl0FcDhXKbqWpQAxuX138Y';
		$config['twitter_access_secret2']		= '2Bklm7e1izziYvbt2Xie18gw82gwUGsUVZX8Pbg';
		break;
}

