# Appointment Management System for Clinics  #

An Appointment Management System for clinics developed with the help of following technologies

* Codeigniter v3.1.10
* MySQL
* Bootstrap v3.3.7
* jQuery v3.3.1
* jQuery UI v1.12.1
* Full Calendar

### Current Functionality ###

* Appointment Module
* Doctor Module
  * Doctor Specialization Module
* Patient Module
* Schedule Module
* Prescription Module
* Admin Module
* Dashboard

### How to Install ###

##### Clone the repo with #####

`git clone https://github.com/shery089/appointment-management-system.git`

##### Import the DB #####

`ams.sql` is the DB file can be find inside the database folder in the root directory of this repo.

## Setup Virtual Host

Add this entry in your server Virtual Host file. Example: For apache the file is httpd-vhosts.conf

Modify the settings according to your needs.

`<VirtualHost *:80>`

    DocumentRoot "C:/xampp/htdocs/appointment-management-system"
    ServerName local.ams.com
    ErrorLog "logs/local.ams.com-error.log"
    CustomLog "logs/local.ams.com-access.log" common
`</VirtualHost>`

* Add **ServerName** entry in your operating system hosts file.
**Example:** `127.0.0.1  		local.ams.com`


* Turn on `rewrite_module` 

## Setup Environment

Rename the `.env-example` file to `.env` file and modify the variables according to your environment.

## Back Office URL 
`ServerName/a/login`
**Example:** `local.ams.com/a/login`

## Credentials:

**Email: john.doe@example.com**

**Password: 12345678**

## Front Office URL 
`ServerName/f/home`
**Example:** `local.ams.com/f/home`

Good Luck!