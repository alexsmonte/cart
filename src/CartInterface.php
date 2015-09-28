<?php 

namespace Cart;

use Cake\Controller\Component;

interface CartInterface
{
    public function list();
    
    public function add(Array $product);
    
    public function delete($product_id);
    
    public function initialize(Component $component);
}

?>