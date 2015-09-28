<?php
use Cake\Core\Configure;

if (!Configure::read('Cart.classname')) {
    Configure::write('Cart.classname', 'SessionCart');
}
if (!Configure::read('Cart.database')) {
    Configure::write('Cart.database', 'default');
}