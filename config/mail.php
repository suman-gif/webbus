<?php
return [
  "driver" => "smtp",
  "host" => "smtp.mailtrap.io",
  "port" => 2525,
  "from" => array(
      "address" => "from@example.com",
      "name" => "Example"
  ),
  "username" => "15f766b97902f0",
  "password" => "37001701f2d46e",
  "sendmail" => "/usr/sbin/sendmail -bs"
];