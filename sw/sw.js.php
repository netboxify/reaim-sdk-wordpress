<?php
  // header("Service-Worker-Allowed: /wp-content/plugins/reaim");
	header("Content-Type: application/javascript");
  header("X-Robots-Tag: none");
  echo "importScripts('https://cdn.reaim.me/js/reaim-sw.min.js');";
?>