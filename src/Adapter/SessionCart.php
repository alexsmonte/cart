<?php 
namespace Cart\Adapter;

use Cart\CartInterface;
use Cake\Controller\Component;
use Cake\Network\Session as CakeSession;


class SessionCart implements CartInterface
{

    protected $products = [];
    private $session;
    
    public function __construct()
    {
        $this->session  = new CakeSession;
    }
    
    public function initialize(Component $component)
    {
        if (!$this->session->check('shop.cart'))
            $this->session->write('shop.cart', []);
    }    
    
    public function add(Array $product)
    {
        if (!is_array($product))
            return false;
        
        $key    =   $this->get($product['product_id']);

        if ($key === false)
            $this->$products = array_merge($this->products, [$product]);
        else
            $this->products[$key]["quantity"]   += 1;

        $this->set();
        
        return true;
    }
    
    public function delete($product_id)
    {
        $key    =   $this->get($product_id);

        if ($key !== false)
        {
            unset($this->products[$key]);
            $this->set();
            return true;
        }

        return false;
    }

    public function list()
    {
        return $this->session->write('shop.cart');
    }
    
    /***
    * Retorna a chave do array
    * Return the key of an array
    **/
    protected function get($product_id)
    {
        return array_search($product_id, array_column($this->products, 'product_id'));
    }
    
    protected function set()
    {
        $this->session->write('shop.cart', $this->products);
    }
    
}
