all:
	php -S localhost:8000 -t public
off:
	sudo systemctl stop mysql
on:
	sudo systemctl start mysql