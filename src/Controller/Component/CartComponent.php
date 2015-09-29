<?php 

namespace Cart\Controller\Component;

use Cart\CartInterface;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\IniConfig;
use Cake\Core\Exception\Exception;

class CartComponent extends Component
{

    protected $_Instance = null;

    
    public function __construct(ComponentRegistry $collection, array $config = [])
    {
        parent::__construct($collection, $config);
        
        $className = $name = Configure::read('Cart.classname');
        if (!class_exists($className)) {
            $className = App::className('Cart.' . $name, 'Adapter');
            if (!$className) {
                throw new Exception(sprintf('Could not find {0}.', [$name]));
            }
        }
        $this->adapter($className);
    }
    
    public function adapter($adapter = null)
    {
        if ($adapter) {
            if (is_string($adapter)) {
                $adapter = new $adapter();
            }
            if (!$adapter instanceof CartInterface) {
                throw new Exception('CartComponent adapters must implement CartInterface');
            }
            $this->_Instance = $adapter;
            $this->_Instance->initialize($this);
            return;
        }
        return $this->_Instance;
    }
    
    
    public function all()
    {
        return $this->_Instance->all();
    }
    
    public function add($product)
    {
        return $this->_Instance->add($product);
    }
    
    public function delete($product_id)
    {
        return $this->_Instance->delete($product_id);
    }
}
