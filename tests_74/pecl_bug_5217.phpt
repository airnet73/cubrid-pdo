--TEST--
PDO Common: PECL Bug #5217 (serialize/unserialze safety)
--SKIPIF--
<?php # vim:ft=php
if (!extension_loaded('pdo')) die('skip');
require_once 'pdo_test.inc';
PDOTest::skip();
?>
--FILE--
<?php
require_once 'pdo_test.inc';
$db = PDOTest::factory();
try {
	$ser = serialize($db);
	debug_zval_dump($ser);
	$db = unserialize($ser);
	$db->exec('CREATE TABLE cubrid_test (id int NOT NULL PRIMARY KEY, val VARCHAR(10))');
} catch (Exception $e) {
	echo "Safely caught " . $e->getMessage() . "\n";
}

echo "PHP Didn't crash!\n";
?>
--EXPECT--
Safely caught Serialization of 'PDO' is not allowed
PHP Didn't crash!
