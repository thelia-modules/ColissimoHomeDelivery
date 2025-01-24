<?php

/*
 * This file is part of the Thelia package.
 * http://www.thelia.net
 *
 * (c) OpenStudio <info@thelia.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ColissimoHomeDelivery\EventListeners;

use ColissimoHomeDelivery\ColissimoHomeDelivery;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Api\Bridge\Propel\Event\DeliveryModuleOptionEvent;
use Thelia\Api\Resource\DeliveryModuleOption;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\HttpFoundation\Session\Session;
use Thelia\Core\Translation\Translator;
use Thelia\Model\CountryArea;
use Thelia\Module\Exception\DeliveryException;

class APIListener implements EventSubscriberInterface
{
    /**
     * @param ContainerInterface $container We need the container because we use a service from another module
     *                                      which is not mandatory, and using its service without it being installed will crash
     */
    public function __construct(
        protected ContainerInterface $container,
        protected Session $session
    ) {
    }

    public function getDeliveryModuleOptions(DeliveryModuleOptionEvent $deliveryModuleOptionEvent): void
    {
        if ($deliveryModuleOptionEvent->getModule()->getId() !== ColissimoHomeDelivery::getModuleId()) {
            return;
        }
        $isValid = true;
        $orderPostage = null;
        $locale = $this->session->getLang()->getLocale();

        try {
            $module = new ColissimoHomeDelivery();
            $country = $deliveryModuleOptionEvent->getCountry();

            if (!$country || empty($module->getAllAreasForCountry($country))) {
                throw new DeliveryException(Translator::getInstance()->trans('Your delivery country is not covered by Colissimo'));
            }
            $cart = $deliveryModuleOptionEvent->getCart();
            if (null === $cart) {
                throw new DeliveryException(Translator::getInstance()->trans('No cart found'));
            }
            $orderPostage = $module->getMinPostage(
                $country,
                $cart->getWeight(),
                $cart->getTaxedAmount($country),
                $locale
            );
        } catch (\Exception) {
            $isValid = false;
        }

        $minimumDeliveryDate = ''; // TODO (calculate delivery date from day of order)
        $maximumDeliveryDate = ''; // TODO (calculate delivery date from day of order

        $deliveryModuleOption = new DeliveryModuleOption();
        $deliveryModuleOption
            ->setCode('ColissimoHomeDelivery')
            ->setValid($isValid)
            ->setTitle($deliveryModuleOptionEvent->getModule()->setLocale($locale)->getTitle())
            ->setImage('')
            ->setMinimumDeliveryDate($minimumDeliveryDate)
            ->setMaximumDeliveryDate($maximumDeliveryDate)
            ->setPostage(($orderPostage) ? $orderPostage->getAmount() : 0)
            ->setPostageTax(($orderPostage) ? $orderPostage->getAmountTax() : 0)
            ->setPostageUntaxed(($orderPostage) ? $orderPostage->getAmount() - $orderPostage->getAmountTax() : 0)
        ;

        $deliveryModuleOptionEvent->appendDeliveryModuleOptions($deliveryModuleOption);
    }

    public static function getSubscribedEvents(): array
    {
        $listenedEvents = [];

        /* Check for old versions of Thelia where the events used by the API didn't exists */
        if (class_exists(DeliveryModuleOptionEvent::class)) {
            $listenedEvents[TheliaEvents::MODULE_DELIVERY_GET_OPTIONS] = ['getDeliveryModuleOptions', 129];
        }

        return $listenedEvents;
    }
}
