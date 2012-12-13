<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


User joins the queue
	Text 5050 "Maracuja"
		- Silently register user
	Responds "you are 5th in the queue"
	Responds "you are playing already"
	Responds "you are already in the queue"

System Creates a game
	Responds "table is ready"
	Text "no" get next user
	Text "yes"
	If two users have said yes
		- tweet "game started between @blah and @blah"
		- set game_in_progress = 1