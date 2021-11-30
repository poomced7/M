1ไฟลล์ .htaccess

<IfModule mod_headers.c>
  Header always append X-Frame-Options DENY
</IfModule>

--------------------------------------------------------------------------------------------------------

2ไฟลล์ ส่วน Index หรือส่วน หัว

<?php
header("X-XSS-Protection: 1; mode=block");
header("Strict-Transport-Security: max-age=63072000; includeSubDomains; preload");
?>
-------------------------------------------------------------------------------------------------------
