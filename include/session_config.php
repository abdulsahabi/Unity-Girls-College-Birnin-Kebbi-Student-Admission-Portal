<?php
define("LIFETIME", 3600);
define("PATH", "/");
define("DOMAIN", "");
define("SECURE", true);
define("SAMESITE", "strict");

function start_session()
{
  session_set_cookie_params([
    "lifetime" => LIFETIME,
    "path" => PATH,
    "domain" => DOMAIN,
    "secure" => SECURE,
    "samesite" => SAMESITE,
  ]);

  session_start();
}

function checkCanLastActivity($lastActivity, $isCandidateLogged)
{
  if (time() - $lastActivity > LIFETIME || !$isCandidateLogged) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
  }
}

function checkAdminLastAcitive($adminLastActive, $isAdminLogged)
{
  if (time() - $adminLastActive > LIFETIME || !$isAdminLogged) {
    session_unset();
    session_destroy();
    header("Location: ./index.php");
  }
}

function logout()
{
  session_unset();
  session_destroy();
}
