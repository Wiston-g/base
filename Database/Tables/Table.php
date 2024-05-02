<?php

//namespace Automattic\base\Database\Tables;
/**
 * TODO La informacion de los productos de woocomerce se cuardane en las tablas 
 * `wp_wc_product_meta_lookup` aqui se guarde 
 * @ product_id
 * @ sku
 * @ virtual 
 * @ downloadable
 * @ min_price 
 * @ max_price
 * @ onsale
 * @ stock_quantity
 * @ stock_status
 * @ rating_count
 * @ average_rating
 * @ total_sales 
 * @ tax_status 
 * @ tax_class
 * 
 * `wp_postmeta`
 * @ meta_id -> es el id de la informacion que primary key
 * @ post_id -> Id de donde viene la informacion 
 * @ meta_key -> aqui se guarda el nombre de la informcaion que va a guardar
 * @ meta_value -> la informacion que se va a guardar
 */
class Table
{

  public function __construct()
  {
    $this->create_table_stock_products();
  }

  private static function create_table_stock_products()
  {
    global $wpdb;

    $table_name = $wpdb->prefix . 'stock_products';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        Product_Id  BIGINT(20) NOT NULL AUTO_INCREMENT, 
        Name_Product VARCHAR(45) NULL,  
        Stock_Quantity INT(6) NULL,
        Due_Date DATE NULL,
        Product_wc BOOLEAN DEFAULT FALSE,
        product_id_wc BIGINT(20) NULL,
        PRIMARY KEY (Product_Id)
    );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $result = dbDelta($sql);

    return $result;
  }

  public static function info_wc_product($product_id_wc)
  {
    global $wpdb;

    $table_name1 = $wpdb->prefix . 'wc_product_meta_lookup';
    $table_name2 = $wpdb->prefix . 'posts';
    $table_name = $wpdb->prefix . 'stock_products';

    $query = "SELECT * FROM $table_name WHERE `product_id_wc` = $product_id_wc";
    $valueQuery =  $wpdb->get_results($query, ARRAY_A);
    var_dump($valueQuery);

    if ($product_id_wc !== null) {

      $SQLsearch = "
        SELECT
            p.post_title,
            m.stock_quantity
        FROM
          $table_name2 p
        JOIN
          $table_name1 m ON p.ID = m.product_id
        WHERE
            p.ID = $product_id_wc;
      ";

      $result =  $wpdb->get_results($SQLsearch, ARRAY_A);

      $Name_Product   = $result[0]['post_title'];
      $stock_Quantity = (int) $result[0]['stock_quantity'];

      $sql = "INSERT INTO $table_name (`Product_Id`, `Name_Product`, `Stock_Quantity`, `Due_Date`, `Product_wc`, `product_id_wc`) VALUES (NULL, '$Name_Product', $stock_Quantity, '', '1', '$product_id_wc');";

      return $wpdb->query($sql);
    }
    return;
  }
};

/**
 * INSERT INTO `wp_stock_products` (`Product_Id`, `Name_Product`, `Stock_Quantity`, `Product_wc`, `product_id_wc`) VALUES (NULL, 'Pepsi', '24', '0', NULL);
 */
