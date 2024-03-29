<?php

namespace DoctrineProxies\__CG__\Domain\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class PurchaseOrder extends \Domain\Entities\PurchaseOrder implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'id', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'provider', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'amount', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'purchaseNumber', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'buyerUser', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'products'];
        }

        return ['__isInitialized__', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'id', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'provider', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'amount', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'purchaseNumber', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'buyerUser', '' . "\0" . 'Domain\\Entities\\PurchaseOrder' . "\0" . 'products'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (PurchaseOrder $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getProvider()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProvider', []);

        return parent::getProvider();
    }

    /**
     * {@inheritDoc}
     */
    public function setProvider($provider): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProvider', [$provider]);

        parent::setProvider($provider);
    }

    /**
     * {@inheritDoc}
     */
    public function getAmount(): \Money\Money
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAmount', []);

        return parent::getAmount();
    }

    /**
     * {@inheritDoc}
     */
    public function setAmount(\Money\Money $amount): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAmount', [$amount]);

        parent::setAmount($amount);
    }

    /**
     * {@inheritDoc}
     */
    public function getPurchaseNumber(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPurchaseNumber', []);

        return parent::getPurchaseNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setPurchaseNumber(string $purchaseNumber): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPurchaseNumber', [$purchaseNumber]);

        parent::setPurchaseNumber($purchaseNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getBuyerUser(): \Domain\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBuyerUser', []);

        return parent::getBuyerUser();
    }

    /**
     * {@inheritDoc}
     */
    public function setBuyerUser(\Domain\Entities\User $buyerUser): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBuyerUser', [$buyerUser]);

        parent::setBuyerUser($buyerUser);
    }

    /**
     * {@inheritDoc}
     */
    public function getProducts(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProducts', []);

        return parent::getProducts();
    }

    /**
     * {@inheritDoc}
     */
    public function setProducts(array $products): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProducts', [$products]);

        parent::setProducts($products);
    }

}
