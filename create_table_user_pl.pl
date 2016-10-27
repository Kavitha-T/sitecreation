#!usr/bin/perl

use strict;
use warnings;
use File::Slurp;
use DBI;
use Digest::MD5 qw(md5 md5_hex md5_base64);

#arguments
my $num_args_needed = 15;
if (@ARGV != $num_args_needed) 
{
    print "\nUsage: server port dbuname dbpwd sitename firstname lastname displayname username password emailid userlevel custid groupid snode \n";
    exit;
}
 
my $dbname    = $ARGV[4];
my $firstname = $ARGV[5];
my $lastname  = $ARGV[6];
my $dname     = $ARGV[7];
my $username  = $ARGV[8];
my $password  = md5_hex($ARGV[9]);
my $email     = $ARGV[10];
my $userlevel = $ARGV[11];
my $custid    = $ARGV[12];
my $groupid   = $ARGV[13];
my $snode     = $ARGV[14];

# MySQL connection string
my $database   = "";
my $driver     = "mysql";
my $server     = $ARGV[0]; 
my $port       = $ARGV[1];
my $dsn        = "DBI:$driver:database=$dbname;host=$server;port=$port";

my $dbusername = $ARGV[2];
my $dbpassword = $ARGV[3];

#Connect to MySQL
my $dbh = DBI->connect($dsn,$dbusername,$dbpassword);

#check if mail id exist
my $sth = $dbh->prepare("SELECT f_id from $dbname.__t_users WHERE f_email = ?");
   $sth->execute($email);
my $row = $sth->fetchrow_array();
   $sth->finish();

#print error msg if email-id already exist
if($row)
{
print "<script>alert('Email id already exist')</script>";
print "Email id already exist";
}

else
{

#insert user details in --t_users table 
my $sth2 = $dbh->prepare("INSERT INTO $dbname.__t_users                                                            (f_username,f_password,f_userlevel,f_group_id,f_first_name,f_last_name,f_display_name,f_email,f_customer_id,f_start_node) VALUES ( ?,?,?,?,?,?,?,?,?,? ) ");
             
   $sth2->execute( $username,$password,$userlevel,$groupid, $firstname, $lastname,$dname, $email, $custid ,$snode ) or print "SQL Error : $DBI::errstr \n";
   $sth2->finish(); 


#get fid to update apikey
my $sth = $dbh->prepare("SELECT f_id from $dbname.__t_users WHERE f_email = ?");
   $sth->execute($email);

while(my $row = $sth->fetchrow_array())
{

#hash email and f_id to get apikey
my $apikey = md5_hex($email,$row);

#update apikey
$sth2 = $dbh->prepare("UPDATE $dbname.__t_users SET f_apikey = ? WHERE f_id=?");
$sth2->execute($apikey,$row);
$sth2->finish();

}
   $sth->finish();
}

print"<script>alert('User created for $dbname - table __t_user')</script>";
