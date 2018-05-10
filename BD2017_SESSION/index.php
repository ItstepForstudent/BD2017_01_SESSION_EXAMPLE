<?php
include "mysession.php";
sessionRun();
//sessionSet("name","vasia");
echo sessionGet("name");