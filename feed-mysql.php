<?php 
session_start();
/*credentials for the database */
@define('DB_USER', 'root');
@define('DB_PASSWORD', 'samael');
@define('DB_HOST', 'localhost');
@define('DB_NAME', 'psdsv');



/** returns a BibDatabase object created from the content of $bibtex_file */
function init_bibtexbrowser($bibtex_file) {
  $_GET['bib'] = $bibtex_file;
  $_GET['library'] = 1;
  include('lib/bibtexbrowser.php');
  setDB();
  $database = $_GET[Q_DB]; 
  return $database;
}

/** returns the list of fields used in the BibDatabase object $bibdb */
function get_field_list($bibdb) {
  $entries = $bibdb->bibdb;
  $result = array();
  foreach($entries as $entry) {
    foreach($entry->getFields() as $k => $v) {
      @$result[$k]++;
    }
  }
  return array_keys($result);
}


/** sets the schema of the mysql DB based on $field_list and BIBTEX_TABLE */
function init_db($field_list) {
  $link = mysqli_connect("localhost", "root", "samael", "psdsv");

  // Check connection
  if ($link === false) {
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  // // introspection 2
  // $tablename = $bibentry->getType();

  
  // // altering table to add missing columns
  // foreach($field_list as $field) {
  //   if (!in_array($field,$columns) && strtolower($field)!='key') {
  //      // altering the table
  //      $tablename = $bibentry->getType();
  //      $query = 'alter table '.$tablename.' add `'.$field.'` TEXT NULL;';
  //      $result = mysqli_query($link,$query) or die('Query failed: ' . mysql_error());    
  //   }
  // }
}

/** adds escape and quotes around an HTML string; the string is also converted to UTF-8 */
function create_mysql_string_from_bibtexbrowser_value($link, $f) {
  return "'".mysqli_real_escape_string($link,html_entity_decode($f,ENT_NOQUOTES,'UTF-8'))."'";
}

/** feeds a MySQL database using the content of the BibDatabase object $bibdb.
 *
 * The MySQL schema is usually created using function init_db
 */
function feed_database($bibtex_db) {

  $link = mysqli_connect("localhost", "root", "samael", "psdsv");

  // Check connection
  if ($link === false) {
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  //print_r($bibtex_db->bibdb);
  
  foreach($bibtex_db->bibdb as $key=>$entry) {
    // do we have an entry ?
    $tablename = $entry->getType();

    /*create the new table if not exists */
    $query = 'CREATE TABLE IF NOT EXISTS '.$tablename.' (bibtexkey VARCHAR(255), PRIMARY KEY (bibtexkey)) ENGINE = MyISAM DEFAULT CHARSET=UTF8;';
    $result = mysqli_query($link,$query) or die('Query failed: ' . mysql_error());

    //print_r($tablename) .'<br/>'.'<br/>';
    $query = 'select * from '.$tablename.' where bibtexkey=\''.$entry->getKey().'\';';
    //echo $query .'<br/>'.'<br/>';
    $result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));    
    //print_r($result) .'<br/>'.'<br/>';
    if (mysqli_num_rows($result) > 0) {
      // updating the entry
      $fields = $entry->fields;
      $updates = array ();
      foreach ($fields as $k=>$v) {
        if ($k!='key' && $k!='_author' && $k!='x-bibtex-type') {
          $updates[] = $k.'='.create_mysql_string_from_bibtexbrowser_value($link,$v);
        }
      }
      //echo 'updating '.$entry->getKey().'<br/>'.'<br/>';
      $tablename = $entry->getType();
      $query = 'update '.$tablename.' set '.implode(',',$updates).' where bibtexkey=\''.$entry->getKey().'\';';
      //echo $query .'<br/>'.'<br/>';
      $result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));        
    } else {
      // no such key
      $fields = $entry->fields;
      unset($fields["_author"]);
      unset($fields["x-bibtex-type"]);
      $keys = array ();
      foreach (array_keys($fields) as $f) { 
        if ($f!='key') {$keys[] = $f;}
        else {$keys[] = 'bibtexkey';}
      }

      $values = array ();
      foreach (array_values($fields) as $f) { 
        $values[] = create_mysql_string_from_bibtexbrowser_value($link, $f);
      }

      $query = 'show columns from '.$tablename.';';
      $result = mysqli_query($link,$query) or die('Query failed: ' . mysql_error());
      $columns = array();
      while ($line = mysqli_fetch_row($result)) { 
        $columns[] = $line[0];
      }
      
      $tablename = $entry->getType();
      foreach (array_keys($fields) as $field) {
        if (!in_array($field,$columns) && strtolower($field)!='key') {
          $query = 'alter table '.$tablename.' add `'.$field.'` TEXT NULL;';
          $result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));    
        }
      }

     

      //echo 'adding '.$entry->getKey().'<br/>'.'<br/>';
      $query = 'insert into  '.$tablename.'('.implode(',',$keys).')  values ('.implode(',',$values).');';
      //echo $query.'<br/>'.'<br/>';
      $result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));    
    }

    if ($entry->getAuthor() == 'Unknown'){
      $authors = ($entry->getEditors());
    }else{
      $authors = $entry->getAuthor();
      $authors = str_replace(" and ",", ",$authors);
      $authors = explode(",",$authors);
    }
    foreach( $authors as $at){
      $authorentity = html_entity_decode(trim($at), ENT_QUOTES, "UTF-8");
      $query = 'insert into  WRITTEN (`author`, `bibtexkey`) values ("' . $authorentity . '", "' . $entry->getKey() . '")';
      
      $result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));  
    }

    //print_r($entry->getAuthor() .'<br/>'.'<br/>' );
    
  } // end foreach
} // end function 


$filename =  $_SESSION['filename'];
print_r ($filename);
$bibtex_db = init_bibtexbrowser($filename);
$field_list = get_field_list($bibtex_db);
init_db($field_list);
feed_database($bibtex_db);

header('Location: showpublication.php');
?>