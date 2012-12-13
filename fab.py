from fabric.api import *

"""
these functions won't work if you haven't got the outsideline.pem certificate. you can
get it from the amazon aws console. login details are in the hosting doc.
"""

def live():
	"""Set the target to production."""
	env.hosts=['kurosaki@setr.co.uk']
	env.remote_app_dir='~/htdocs/makeday.setr.co.uk/'


def yeah():
	print "thafe, yeah?"
	
	
def push():
	"""Pushes the code to nominated server - restart included - doesn't touch the db"""
	require('hosts', provided_by=[live,])

	run("cd %s; git pull" % env.remote_app_dir)


def restartserver():
	"""Restarts the nominated server services, apache, memcached and mysql"""
	require('hosts', provided_by=[live,])

	sudo("service mysql restart")
	sudo("/etc/init.d/apache2 restart")
