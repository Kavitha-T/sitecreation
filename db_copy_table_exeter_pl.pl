#!usr/bin/perl
use strict;
use warnings;
use File::Slurp;
use DBI;

my $num_args_needed = 8;

if (@ARGV != $num_args_needed) {
    print "\nUsage: mysql_server existingdb username password port sitename version page_server \n";
    exit;
    }

my $server     = $ARGV[0];
my $dbexisting = $ARGV[1];
my $username   = $ARGV[2];
my $password   = $ARGV[3];
my $port       = $ARGV[4];
my $dbnew      = $ARGV[5];
my $version    = $ARGV[6];
my $pserver    = $ARGV[7];


# MySQL connection string
my $database = "";
my $driver   = "mysql";
my $dsn      = "DBI:$driver:database=$database;host=$server;port=$port";

my @lines;
my @stash;
my @tbrow;
my @structure;
my $structure;

my $sth;
my $sth2;
my $tbname;
my $tbrow;
my $nrows = 1;
my $totrows;


#Connect to MySQL
my $dbh = DBI->connect($dsn,$username,$password);


#Create new db based on userinput - 
$sth = $dbh->do("CREATE DATABASE $dbnew DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci") 
or die print "<script>alert('Database $dbnew already exist.SQL Error: $DBI::errstr')</script>";

print "New Database Created in the name $dbnew <br>";

print "About to gather tables from '$dbexisting' database...<br>";
$sth = $dbh->prepare("SHOW TABLES FROM $dbexisting");
$sth->execute() or die print "SQL Error: $DBI::errstr \n";

#Total tables in the existing db
$totrows = $sth->rows();
print "Total Number of Tables: $totrows <br>";

#List all tables from the existing database
print "List of tables <br>";
while ($tbrow = $sth->fetchrow_array()) {
     print "$nrows . $tbrow <br>";
	 push (@tbrow,  $tbrow );
 	 $nrows++;
    }

print "<br>";

#check if table is found in config file
foreach $tbname(@tbrow) {
    @lines = read_file("tableconfig.ini");
    chomp(@lines);
    while (<@lines>) {
        if(/$tbname/) {
            push (@stash,  $tbname );
            }
        }
    }

#remove duplicates and save it in structure array
my %temp_hash = map { $_, 0 } @stash;
@structure = keys %temp_hash;
foreach $tbname(@structure)
{
    #create structure for tables found in config file 
    $sth = $dbh->prepare("CREATE TABLE IF NOT EXISTS $dbnew.$tbname LIKE $dbexisting.$tbname");
    $sth->execute() or die print "SQL Error : $DBI::errstr \n";

    print "Table structure created for $tbname<br>";
} 

#remove the tables which are in config 
foreach $structure(@structure) {
    @tbrow = grep {!/$structure/} @tbrow;
    }
foreach $tbname(@tbrow) {
    #copy data for tables which are not found in config file 
    $sth = $dbh->prepare("CREATE TABLE IF NOT EXISTS $dbnew.$tbname LIKE $dbexisting.$tbname");
    $sth->execute() or die print "SQL Error : $DBI::errstr \n";

    $sth2 = $dbh->prepare("INSERT IGNORE INTO $dbnew.$tbname SELECT * FROM $dbexisting.$tbname");
    $sth2->execute() or die print "SQL Error : $DBI::errstr \n";

    print " Table data copied for $tbname <br>";
    }


#insert into ams_cms database
my $fpage = "index.php";

$sth = $dbh->prepare("INSERT INTO ama_cms.t_dn_controller (f_url_match, f_site_name, f_version, f_pg_server, f_page, f_click_web_server) 
                      VALUES (?, ?, ?, ?, ?,?)");
$sth->execute("$dbnew.cms.kriyadocs.com",$dbnew, $version, $pserver, $fpage, "cms30") or die print "SQL Error : $DBI::errstr \n";

$sth = $dbh->prepare("INSERT INTO ama_cms.t_dn_controller (f_url_match,f_site_name, f_version, f_pg_server, f_page, f_click_web_server) 
                      VALUES (?, ?, ?, ?, ?,?)");
$sth->execute("$dbnew.kriyadocs.com",$dbnew, $version, $pserver, $fpage, "cms31") or die print "SQL Error : $DBI::errstr \n";

$sth = $dbh->prepare("INSERT INTO ama_cms.t_dn_controller (f_url_match,f_site_name, f_version, f_pg_server, f_page, f_click_web_server) 
                      VALUES (?, ?, ?, ?, ?,?)");
$sth->execute("api.$dbnew.kriyadocs.com",$dbnew, $version, $pserver, $fpage, "cms31") or die print "SQL Error : $DBI::errstr \n";

$sth->finish();

print "<br>Inseted the values into ama_cms database successfully <br>";

#create db user for newdb
$sth = $dbh->prepare("CREATE USER '$dbnew'\@'$server' IDENTIFIED BY 'password123' ");
$sth->execute() or die print "SQL Error : $DBI::errstr \n";
$sth->finish();

#set privileges
$sth2 = $dbh->prepare("GRANT CREATE,INSERT,SELECT,DELETE,UPDATE,ALTER ON $dbnew.* TO '$dbnew'\@'$server' ");
$sth2->execute() or die print "SQL Error : $DBI::errstr \n";
$sth2->finish();

print "User created for $dbnew \n"; 

#insert into customertable
$sth2 = $dbh->prepare("INSERT IGNORE INTO $dbnew.t_customers (f_id,f_start_node,f_tagging_menu ) VALUES (2,2,1159)");
$sth2->execute() or die print "SQL Error : $DBI::errstr \n";

#insert 
print "Inserted the values in t_customer table \n";
print "<script>alert('Finished')</script>";

 __END__
