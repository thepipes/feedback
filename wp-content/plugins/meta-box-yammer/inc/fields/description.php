<?php
// Prevent loading this file directly - Busted!
if( ! class_exists('WP') )
{
  header( 'Status: 403 Forbidden' );
  header( 'HTTP/1.1 403 Forbidden' );
  exit;
}

if ( ! class_exists( 'RWMBY_Description_Field' ) )
{
  class RWMBY_Description_Field
  {
    /**
     * Get field HTML
     *
     * @param string $html
     * @param mixed  $meta
     * @param array  $field
     *
     * @return string
     */
    static function html( $html, $meta, $field )
    {


      $name		 = "name='{$field['field_name']}'";
      $id			 = " id='{$field['id']}'";
      $val		 = " {$meta}";

      $html		.= "";

      return $html;
    }
  }
}