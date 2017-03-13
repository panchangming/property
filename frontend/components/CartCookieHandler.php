<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 14:37
 */

namespace frontend\components;

use frontend\models\Cart;
use yii\web\Cookie;
use yii\base\Model;

class CartCookieHandler extends Model
{
    private $_cart = [];
    public $cookie_id = 'cart';

    public function init()
    {
        $cart = \Yii::$app->request->cookies->get($this->cookie_id);
        if ($cart) {
            $this->_cart = unserialize($cart);
        }
        parent::init();
    }

    //添加一个商品id 数量
    public function add($id, $num)
    {
        if ($this->exist($id)) {
            $this->update($id, $num);
        } else {
            $this->_cart[$id] = $num;
        }
        return $this;
    }

    //删除一个商品
    public function del($id)
    {
        if ($this->exist($id)) {
            unset($this->_cart[$id]);
        }
        return $this;
    }

    //修改一个商品数量
    public function update($id, $num)
    {
        if ($this->exist($id)) {
            $this->_cart[$id] = $num;
        }
        return $this;
    }

    //获取所有商品信息
    public function all()
    {
        return $this->_cart;
    }

    //判断是否存在某个商品
    public function exist($id)
    {
        return key_exists($id, $this->_cart);
    }

    //保存到cookie
    public function exec()
    {
        $cookies = \Yii::$app->response->cookies;
        $cookies->add(new Cookie([
            'name' => $this->cookie_id,
            'value' => serialize($this->_cart),
            'expire' => time() + 7 * 24 * 3600
        ]));
    }

    public function mergeToTable()
    {
        //cookie中没有购物车数据，无需执行合并操作，直接返回
        if (empty($this->_cart)) return;

        foreach ($this->_cart as $good_id => $num) {
            $cart = Cart::findOne(['goods_id' => $good_id, 'member_id' => \Yii::$app->user->id]);
            if ($cart == null) {
                $cart = new Cart();
                $cart->goods_id = $good_id;
                $cart->member_id = \Yii::$app->user->id;
            }
            $cart->amount = $num;
            $cart->save();
        }
        //清空cookie中的购物车数据
        $this->_cart = [];
        $this->exec();
    }
}