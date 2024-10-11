It's a file system base

/home, /root

Make root user:- --sudo su

gedit, chmod, +wrx, ./, bash

apt -get update

apt -get upgrade

apt -get install gedit

top, kill-PID, whoami,w , touch

Hostname, Host

/etc/appache.config

/etc/port.config 

htop, du -h, df -h, lscpu, lsblk, cat /etc/os-release 


----------------------------------
#Copy file with ssh 
scp myfile root@186.142.3.23:/home/paul 

#add user 
useradd sandeep

#add group 
groupadd chilout

#del user 
userdel sandeep

#Check appache status 
systemctl status httpd.service 
systemctl status nginx.service 
systemctl start nginx.service 

#For schedule 
at

# Overwrite output
  >
echo "Hello" > /home/sandeep/output.txt

# Append output
  >>
echo "Hello" >> /home/sandeep/output.txt
------------------------
sudo apt install cron

#Check logs
tail -f /var/log/syslog 

# List cron
crontab -l

# Edit cron
crontab -e

EX:- 
* * * * * /home/sandeep/myscript.sh, 
* * * * * echo "Hello" >> /home/sandeep/output.txt

# Remove all
crontab -r

# Check is service work or not
service cron status

# Start, Stop, Restart service 
service cron start
service cron restart
service cron stop

----------------------------------