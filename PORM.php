<?php

/*
 * PORM uses a Database Markup in the form of a JSON object that describes a database through its tables and constituant types.
 * PORM is built on the PDO component of the Page framework.  http://github.com/h3rb/page
 *
 * Usage Example:
 *  Instantiation:
 *  $porm = new PORM( $json_string );
 *
 * To seed or modify the database:
 *  $porm->Deploy( $db, $svr, $un, $pass, 3306, TRUE );
 */

 class PORM {
  var $_json,$tree;
  public function __construct( $PORM_json ) {
  }
  /*
   * If $overwrite is set to anything other than TRUE, Deploy will attempt to modify, rather than rewrite.
   * If the database does not exist, the database will be created.
   */
  public function Deploy( $database, $server, $username, $password, $port=3306, $overwrite=TRUE ) {
  }
  
 };
