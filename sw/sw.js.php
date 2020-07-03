<?php
  header("Service-Worker-Allowed: /wp-content/plugins/reaim");
	header("Content-Type: application/javascript");
  header("X-Robots-Tag: none");
  echo "importScripts('https://micko.dev/reaim-sw.js');";
?>