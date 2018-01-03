<?php

/*
  cactus lamp controller

LED IDs:
 [1] [3] [7]
 [2] [4] [8]
  \  [5]  /
     [6]


    Now add the GPIO pin IDs to the corresponding LED IDs below
    like this:
    
    $pins[ LED ID ] = GPIO PIN
*/

$pins[1] = 2;
$pins[2] = 3;
$pins[3] = 14;
$pins[4] = 4;
$pins[5] = 15;
$pins[6] = 23;
$pins[7] = 17;
$pins[8] = 18;

if($_GET['getstatus'])
{
    foreach($pins as $lamp => $pin)
    {
        $lampstatus[$lamp] = intval(trim(shell_exec("sudo /usr/bin/gpio -g read $pin")));
    }

    exit(json_encode($lampstatus));
}

$lamp = $_REQUEST['lamp'];
$status = $_REQUEST['status'];
$port = $pins[$lamp];

//if we got some crazy data, lets not do anything
if(!is_numeric($lamp) || !$port || !is_numeric($status) || !in_array($lamp,$pins) || ($status>1 && $status<0))
  exit('Nope');

//execute the command
@shell_exec("sudo /usr/bin/gpio -g write $port $status");
echo "OK";