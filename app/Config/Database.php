<?php

namespace Config;

/**
 * Database Configuration
 *
 * @package Config
 */

class Database extends \CodeIgniter\Database\Config
{
	/**
	 * The directory that holds the Migrations
	 * and Seeds directories.
	 *
	 * @var string
	 */
	public $filesPath = APPPATH . 'Database/';

	/**
	 * Lets you choose which connection group to
	 * use if no other is specified.
	 *
	 * @var string
	 */
	//bcsfit123 PASSWORD USERNAME
	public $defaultGroup = 'default';

	/**
	 * The default database connection.
	 *
	 * @var array
	 */
	public $default = [
		'DSN'      => 'mysql:host=192.168.99.221;dbname=bcsfit',
		'hostname' => '192.168.99.221',
		'username' => 'root',
		// 		'username' => 'root',
		// 'password' => 't4ny4p4k0f4',
		// 		'password' => 'c1l3g0nbcs555_999*',
		'database' => 'bcsfit',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => true,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];


	public $hris = [
		'DSN'      => 'mysql:host=192.168.99.221;dbname=hris',
		'hostname' => '192.168.99.221',
		'username' => 'root',
		// 'password' => 't4ny4p4k0f4',
		// 		'username' => 'bcsfit',
		// 		'password' => 'c1l3g0nbcs555_999*',
		'database' => 'hris',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => true,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];

	public $ims = [
		'DSN'      => 'mysql:host=192.168.99.221;dbname=ims',
		'hostname' => '192.168.99.221',
		'username' => 'root',
		// 'password' => 't4ny4p4k0f4',
		// 		'username' => 'bcsfit',
		// 		'password' => 'c1l3g0nbcs555_999*',
		'database' => 'ims',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => true,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];
	/**
	 * This database connection is used when
	 * running PHPUnit database tests.
	 *
	 * @var array
	 */
	// public $tests = [
	// 	'DSN'      => '',
	// 	'hostname' => '127.0.0.1',
	// 	'username' => '',
	// 	'password' => '',
	// 	'database' => ':memory:',
	// 	'DBDriver' => 'SQLite3',
	// 	'DBPrefix' => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
	// 	'pConnect' => false,
	// 	'DBDebug'  => (ENVIRONMENT !== 'production'),
	// 	'cacheOn'  => false,
	// 	'cacheDir' => '',
	// 	'charset'  => 'utf8',
	// 	'DBCollat' => 'utf8_general_ci',
	// 	'swapPre'  => '',
	// 	'encrypt'  => false,
	// 	'compress' => false,
	// 	'strictOn' => false,
	// 	'failover' => [],
	// 	'port'     => 3306,
	// ];

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		// Ensure that we always set the database group to 'tests' if
		// we are currently running an automated test suite, so that
		// we don't overwrite live data on accident.
		if (ENVIRONMENT === 'testing') {
			$this->defaultGroup = 'tests';

			// Under Travis-CI, we can set an ENV var named 'DB_GROUP'
			// so that we can test against multiple databases.
			if ($group = getenv('DB')) {
				if (is_file(TESTPATH . 'travis/Database.php')) {
					require TESTPATH . 'travis/Database.php';

					if (! empty($dbconfig) && array_key_exists($group, $dbconfig)) {
						$this->tests = $dbconfig[$group];
					}
				}
			}
		}
	}

	//--------------------------------------------------------------------

}
