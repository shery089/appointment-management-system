# Appointment Management System for Clinics  #

An Appointment Management System for clinics developed with the help of following technologies

* Codeigniter v3.1.10
* MySQL
* Bootstrap v3.3.7
* jQuery v2.2.4
* jQuery UI v1.12.1
* Full Calendar

### Current Functionality ###

#### Back Office Application
* Appointment Module: <br>
CRUD operations for appointment and search appointments by applying **date, visit time and MR-Number** filters.
Note: Doctor name and morning/evening shift time will only appear in the add/edit section of appointment. When a doctor is created in the doctor module and weekly schedule is added in the schedule module.
* Doctor Module
CRUD operations for doctor and search doctors by applying **doctor name, specialization and mobile number** filters.
  * Doctor Specialization Module
  Its a sub-module of Doctors Module. It has CRUD operations for doctor specializations. These specializations associate with doctor e.g. John Doe's specialization is General Surgeon.
* Patient Module
CRUD operations for patients and search patients by applying **mobile number, father name and MR-Number filter.** filters.
* Schedule Module
Add weekly schedule of doctor.
* Prescription Module
It contains prescriptions for patients. PDF of prescription is available for download in this module.  
* Admin Module: <br>
Add new administrator users for admin panel.
* Dashboard: <br>
User can search appointments for specific date by applying **time** and **doctor name** filters.

#### Front Office App

There are two types of patient i.e. A Returning Patient and New Patient.
For both patient types fill the information.
#####How to schedule an appointment?
First, select an appointment date. Then, in the doctor dropdown available doctors at the specific appointment date will appear.
After selecting the doctor choose the appointment shift i.e. evening or morning by clicking on the checkbox and select the time.


### Note: 
Doctors and Schedule shift will only appear 
in the dropdown of front office application. If you 
add doctors and their associated schedules from the 
back office application or admin panel.

You have to add weekly schedules for doctor. 
Please check <a href="#suggestions">suggestions</a> in the bottom of this file.  

### How to Install ###

##### Clone the repo with #####

`git clone https://github.com/shery089/appointment-management-system.git`

##### Import the DB #####

`ams.sql` is the DB file can be find inside the database folder in the root directory of this repo.

##### Install PHP dependencies via composer #####

`composer install`

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

##Suggestions:

If the doctors schedule is always the same for your clinic. Then, create and once in a week run a cronjob to add weekly schedules of doctor. Otherwise, change the schedule module according to your needs.

Good Luck!