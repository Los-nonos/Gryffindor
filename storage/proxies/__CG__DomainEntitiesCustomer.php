<?php

namespace DoctrineProxies\__CG__\Domain\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Customer extends \Domain\Entities\Customer implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'id', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'uuid', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'email', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'age', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'cellPhone', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'dni', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'birthday', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'postalCode', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'country', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'state', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'city', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'vatCondition', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'taxationKey', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'grossIncome', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'orders'];
        }

        return ['__isInitialized__', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'id', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'uuid', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'email', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'age', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'cellPhone', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'dni', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'birthday', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'postalCode', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'country', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'state', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'city', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'vatCondition', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'taxationKey', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'grossIncome', '' . "\0" . 'Domain\\Entities\\Customer' . "\0" . 'orders'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Customer $proxy) {
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
    public function getId(): int
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
    public function getUuid(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUuid', []);

        return parent::getUuid();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail(string $email): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function getAge(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAge', []);

        return parent::getAge();
    }

    /**
     * {@inheritDoc}
     */
    public function setAge(int $age): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAge', [$age]);

        parent::setAge($age);
    }

    /**
     * {@inheritDoc}
     */
    public function getCellPhone(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCellPhone', []);

        return parent::getCellPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setCellPhone(string $cellPhone): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCellPhone', [$cellPhone]);

        parent::setCellPhone($cellPhone);
    }

    /**
     * {@inheritDoc}
     */
    public function getDni(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDni', []);

        return parent::getDni();
    }

    /**
     * {@inheritDoc}
     */
    public function setDni(string $dni): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDni', [$dni]);

        parent::setDni($dni);
    }

    /**
     * {@inheritDoc}
     */
    public function getBirthday(): \DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBirthday', []);

        return parent::getBirthday();
    }

    /**
     * {@inheritDoc}
     */
    public function setBirthday(\DateTime $birthday): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBirthday', [$birthday]);

        parent::setBirthday($birthday);
    }

    /**
     * {@inheritDoc}
     */
    public function getPostalCode(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPostalCode', []);

        return parent::getPostalCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setPostalCode(string $postalCode): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPostalCode', [$postalCode]);

        parent::setPostalCode($postalCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getCountry(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCountry', []);

        return parent::getCountry();
    }

    /**
     * {@inheritDoc}
     */
    public function setCountry(string $country): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCountry', [$country]);

        parent::setCountry($country);
    }

    /**
     * {@inheritDoc}
     */
    public function getState(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getState', []);

        return parent::getState();
    }

    /**
     * {@inheritDoc}
     */
    public function setState(string $state): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setState', [$state]);

        parent::setState($state);
    }

    /**
     * {@inheritDoc}
     */
    public function getCity(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCity', []);

        return parent::getCity();
    }

    /**
     * {@inheritDoc}
     */
    public function setCity(string $city): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCity', [$city]);

        parent::setCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function getVatCondition(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVatCondition', []);

        return parent::getVatCondition();
    }

    /**
     * {@inheritDoc}
     */
    public function setVatCondition(string $vatCondition): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVatCondition', [$vatCondition]);

        parent::setVatCondition($vatCondition);
    }

    /**
     * {@inheritDoc}
     */
    public function getTaxationKey(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTaxationKey', []);

        return parent::getTaxationKey();
    }

    /**
     * {@inheritDoc}
     */
    public function setTaxationKey(?string $taxationKey): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTaxationKey', [$taxationKey]);

        parent::setTaxationKey($taxationKey);
    }

    /**
     * {@inheritDoc}
     */
    public function getGrossIncome(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGrossIncome', []);

        return parent::getGrossIncome();
    }

    /**
     * {@inheritDoc}
     */
    public function setGrossIncome(?string $grossIncome): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGrossIncome', [$grossIncome]);

        parent::setGrossIncome($grossIncome);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrders(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrders', []);

        return parent::getOrders();
    }

    /**
     * {@inheritDoc}
     */
    public function setOrders(array $orders): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOrders', [$orders]);

        parent::setOrders($orders);
    }

}
