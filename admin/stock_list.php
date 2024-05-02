<?php
global $wpdb;
$tabla = $wpdb->prefix . 'stock_products';
$query = "SELECT * FROM $tabla";
$listProducts =  $wpdb->get_results($query, ARRAY_A);

if (empty($listProducts)) {
  $listProducts = array();
};

require_once plugin_dir_path(__DIR__) . 'Database/Tables/Table.php';
$fff = Table::info_wc_product(37);
//$fff = plugin_dir_path(__DIR__);
var_dump($fff);
?>

<section class="wrap">

  <?php
  echo "<h1>" . get_admin_page_title() . "</h1>";
  ?>

  <a id="btnProductStock" class="page-title-action">Añadir Nuevo Producto</a>

  <br><br><br>

  <table class="wp-list-table widefat fixed striped pages">
    <thead>
      <th>Name</th>
      <th>Stock Quantity</th>
      <th>Due Date</th>
      <th>Product wc</th>
      <th>Product id wc</th>
      <th>Actions</th>
    </thead>
    <tbody id="list-products">
      <?php

      foreach ($listProducts as $key => $value) {
        $name           = $value['Name_Product'];
        $stock_Quantity = $value['Stock_Quantity'];
        $due_date       = $value['Due_Date'];
        $product_wc     = ($value['Product_wc'] == 1) ? 'True' : (($value['Product_wc'] == 0) ? 'False' : $value['Product_wc']);
        $product_id_wc  = $value['product_id_wc'];

        echo "<tr>
            <td>$name</td>
            <td>$stock_Quantity</td>
            <td>$due_date</td>
            <td>$product_wc</td>
            <td>$product_id_wc</td>
            <td>
              <a class='btn btn-outline-danger'>Borrar</a>
              <a class='btn btn-outline-secondary'>Detalle</a>
            </td>
          </tr>";
      }
      ?>
    </tbody>
  </table>


</section>

<!--modal-->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modalNewProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Nuevo Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <label for="nameproduct">Nombre producto</label>
              <input type="text" name="nameproduct" id="stockProductName">
              <label for="shorckproduct">Shortcode</label>
              <input type="text" name="shorckproduct" id="stockShorckProduct">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>