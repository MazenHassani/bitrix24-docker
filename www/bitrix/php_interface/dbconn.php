<?php
// Provision this file outside the web root; never commit deployment credentials.
$deploymentCredentials = require '/etc/bitrix/credentials.php';
foreach (array('crypto_key', 'db_host', 'db_name', 'db_user', 'db_password') as $credentialName) {
    if (!is_array($deploymentCredentials) || !isset($deploymentCredentials[$credentialName])
        || !is_string($deploymentCredentials[$credentialName]) || $deploymentCredentials[$credentialName] === ''
        || strpos($deploymentCredentials[$credentialName], 'YOUR_') === 0) {
        throw new RuntimeException('Missing required external Bitrix credential: ' . $credentialName);
    }
}

define("DBPersistent", false);
$DBType = "mysql";
$DBHost = $deploymentCredentials['db_host'];
$DBLogin = $deploymentCredentials['db_user'];
$DBPassword = $deploymentCredentials['db_password'];
$DBName = $deploymentCredentials['db_name'];
$DBDebug = false;
$DBDebugToFile = false;

define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);

define("BX_FILE_PERMISSIONS", 0644);
define("BX_DIR_PERMISSIONS", 0755);
@umask(~(BX_FILE_PERMISSIONS|BX_DIR_PERMISSIONS)&0777);

define("MYSQL_TABLE_TYPE", "INNODB");
define("SHORT_INSTALL", true);
define("VM_INSTALL", true);

define("BX_UTF", true);
define("BX_CRONTAB_SUPPORT", true);
define("BX_COMPRESSION_DISABLED", true);

define("BX_DISABLE_INDEX_PAGE", true);

define("BX_TEMPORARY_FILES_DIRECTORY", "/home/bitrix/.bx_temp/sitemanager/");

define("BX_USE_MYSQLI", true);
?>
