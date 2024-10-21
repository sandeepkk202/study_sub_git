<?php
/*

# How To Install and Manage Supervisor Laravel ubuntu

    A Supervisor is a client/server system that allows its users to monitor and control a number of processes on Ubuntu operating systems. it is a process manager which provides a singular interface for managing and monitoring a number of long-running programs.

# Prerequisites
    - Linux server and a user with Sudo privileges.
    - A Laravel configures the environment in which we run the scheduler.

# Step 1 — Installation
    Begin by updating your package sources and installing Supervisor:

    - sudo apt update && sudo apt install supervisor

    The supervisor service runs automatically after installation. You can check it by these commands:

    - sudo systemctl start supervisor
    - sudo systemctl status supervisor
    - sudo systemctl restart supervisor
    - sudo systemctl reload supervisor

# Optional: How to Enable Supervisor Web Interface
    The supervisor provides a web-based interface to manage all processes, but it is disabled by default. You can enable it by editing the file

    - nano /etc/supervisor/supervisord.conf
    
    Add the following lines on start of the file:

    [inet_http_server]
    port=*:9001
    username=admin
    password=admin

    Save and close the file, then restart the Supervisor service to apply the changes:
    - systemctl restart supervisor
    (htpp://127.0.0.1:9001/login)
    
# Step 2 — Create queue workers
    nano /etc/supervisor/conf.d/laravel-worker.conf

    Configration file Template:
    Supervisor configuration files are typically stored in the "/etc/supervisor/conf.d" directory. Within this directory, you may create any number of configuration files that instruct the supervisor on how your processes should be monitored.

    ------------------    
        ##DEFIULT TEMPLATE  
        [program:_APPNAME_QUEUENAME_WORKER_]
        process_name=%(program_name)s_%(process_num)02d
        ##DEFINE THE COMMANDS.
        #command=php /_PATH_TO_APP_/artisan queue:work sqs --queue=_QUEUE_NAME_ --delay=0 --memory=128 --sleep=3 --tries=1
        ##DEFINE THE COMMANDS.
        command=php /_PATH_TO_APP_/artisan queue:work --sleep=3
        ##GENRATE THE OUTPUT LOGS.
        stdout_logfile=/_PATH_TO_APP_/storage/logs/_APPNAME_QUEUENAME_WORKER_.log
        ##DEFINE THE SYSTEM USER, WHICH YOU USE.
        user=root 
        ##DEFINE NUMBER OF PROCESS,FOR BASIC USE DEFINE MAX "4".
        numprocs=2
        autostart=true
        autorestart=true
        redirect_stderr=true
        stopwaitsecs=3600
    ------------------

    reload the supervisor:
    
    sudo supervisorctl reread
    sudo supervisorctl status
    sudo supervisorctl restart
    
    or start the supervisor again, if not running:
    
    (EXAMPLE)
    sudo supervisorctl start laravel-worker:*
    sudo supervisorctl start _APPNAME_QUEUENAME_WORKER_ : *
    
    Run a CRONTAB on the system to listen to the supervisor to perform tasks:
    
    crontab -e
    
    add this job:
    
    * * * * * cd /var/www/my-laravel-app/backend && php artisan schedule:run >> /dev/null 2>&1
    
    *Optional: also you can use these commands:

    sudo supervisorctl update
    sudo supervisorctl restart all
    sudo supervisorctl shutdown
    sudo supervisorctl stop all

# Step 3— Track and Dealing With Failed Jobs
    Sometimes your queued jobs will fail. Don’t worry, things don’t always go as planned! Laravel includes a convenient way to specify the maximum number of times a job should be attempted. After an asynchronous job has exceeded this number of attempts, it will be inserted into the `failed_jobs` database table.
    Create a table for Failed Jobs:

# Step 3— track the Failed jobs
    Gracefully restart all of the workers:

    php artisan queue:restart
    
    Checks Jobs: Open the Terminal,
    
    php artisan tinker
    
    For jobs Details: you can use these,
    
    DB::collection('jobs')->get()
    DB::collection('failed_jobs')->get()
    DB::collection('password_resets')->get()
    
    *In addition, ensure that you install the AWS SDK so that your Laravel application can communicate with DB:
    
    composer require aws/aws-sdk-php

# Clearing Jobs From Queues
    If you would like to delete all jobs from the default queue of the default connection, you may do so using the `queue:clear` Artisan command:

    php artisan queue:clear

    You may also provide the `connection` argument and `queue` option to delete jobs from a specific connection and queue:

    php artisan queue:clear redis --queue=emails

# Monitoring Your Queues
    To get started, you should schedule the `queue:monitor` command to run every minute. The command accepts the names of the queues you wish to monitor as well as your desired job count threshold:

    // php artisan queue:monitor redis:default,redis:deployments --max=100
    php artisan queue:monitor work:defaul

    HOW TO UNINSTALL SUPERVISOR

    sudo rm -rf /etc/systemd/system/supervisor.service
    sudo rm -rf /usr/sbin/supervisor
    
    */