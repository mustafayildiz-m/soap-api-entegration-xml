<?php

namespace App\Libraries;

class N11Test
{
    protected static $_appKey, $_appSecret, $_parameters, $_sclient;
    public $_debug = false;

    public function __construct(array $attributes = array())
    {
        self::$_appKey = $attributes["api_key"];
        self::$_appSecret = $attributes["api_secret"];
        self::$_parameters = ["auth" => ["appKey" => self::$_appKey, "appSecret" => self::$_appSecret]];
    }

    public function setUrl($url)
    {
        self::$_sclient = new \SoapClient($url);
    }

    public function GetTopLevelCategories()
    {
        $this->setUrl("https://api.n11.com/ws/CategoryService.wsdl");
        return self::$_sclient->GetTopLevelCategories(self::$_parameters);
    }

    public function GetSubCategories($catID)
    {
        $this->setUrl("https://api.n11.com/ws/CategoryService.wsdl");
        self::$_parameters["categoryId"] = $catID;
        return self::$_sclient->GetSubCategories(self::$_parameters);
    }

    public function SaveProduct(array $product = array())
    {
        $this->setUrl("https://api.n11.com/ws/ProductService.wsdl");
        self::$_parameters["product"] = $product;
        return self::$_sclient->SaveProduct(self::$_parameters);
    }

    public function DeleteProductById($productId)
    {
        $this->setUrl("https://api.n11.com/ws/ProductService.wsdl");
        self::$_parameters["productId"] = $productId;
        return self::$_sclient->DeleteProductById(self::$_parameters);
    }

    public function __destruct()
    {
        if ($this->_debug) {
            print_r(self::$_parameters);
        }
    }

}