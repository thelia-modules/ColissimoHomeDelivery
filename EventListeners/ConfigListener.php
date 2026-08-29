<?php

namespace ColissimoHomeDelivery\EventListeners;

use ColissimoHomeDelivery\ColissimoHomeDelivery;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryFreeshippingQuery;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlicesQuery;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Thelia\Model\AreaDeliveryModuleQuery;
use Thelia\Model\ModuleConfigQuery;
use Thelia\Model\ModuleQuery;

class ConfigListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'module.config' => ['onModuleConfigure', 128],
        ];
    }

    public function onModuleConfigure(GenericEvent $event)
    {
        $subject = $event->getSubject();

        if ($subject !== "HealthStatus") {
            throw new \RuntimeException('Event subject does not match expected value');
        }

        $shippingZoneConfig = AreaDeliveryModuleQuery::create()
            ->filterByDeliveryModuleId(ColissimoHomeDelivery::getModuleId())
            ->find();

        $moduleConfig = [];
        $moduleConfig['module'] = ColissimoHomeDelivery::getModuleCode();
        $configsCompleted = true;

        $configModuleFree = ColissimoHomeDeliveryFreeshippingQuery::create()
            ->find();

        $configModuleSlices = ColissimoHomeDeliveryPriceSlicesQuery::create()
            ->find();

        $configModule = ModuleConfigQuery::create()
            ->filterByModuleId(ColissimoHomeDelivery::getModuleId())
            ->filterByName(['colissimo_home_delivery_username', 'colissimo_home_delivery_password', 'affranchissement_endpoint_url'])
            ->find();

        foreach ($configModule as $config) {
            $moduleConfig[$config->getName()] = $config->getValue();
            if ($config->getName() === 'colissimo_home_delivery_username' && $config->getValue() === "") {
                $configsCompleted = false;
            }
            if ($config->getName() === 'colissimo_home_delivery_password' && $config->getValue() === "") {
                $configsCompleted = false;
            }
        }

        foreach ($configModuleFree as $config) {
            $moduleConfig['freeshipping_active'] = $config->getActive();
            $moduleConfig['freeshipping_from'] = $config->getFreeshippingFrom();
            if ($config->getActive()) {
                if ($moduleConfig['colissimo_home_delivery_username'] === ""
                    || $moduleConfig['colissimo_home_delivery_password'] === ""
                    || $moduleConfig['affranchissement_endpoint_url'] === "") {
                    $configsCompleted = false;
                }
            } else {
                if ($configModuleSlices->count() === 0) {
                    $configsCompleted = false;
                }
            }
        }

        if ($shippingZoneConfig->count() === 0) {
            $configsCompleted = false;
        }


        $moduleConfig['completed'] = $configsCompleted;

        $event->setArgument('colissimo_home_delivery.module.config', $moduleConfig);
    }


}