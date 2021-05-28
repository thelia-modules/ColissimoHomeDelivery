<?php
/*************************************************************************************/
/*      Copyright (c) Franck Allimant, CQFDev                                        */
/*      email : thelia@cqfdev.fr                                                     */
/*      web : http://www.cqfdev.fr                                                   */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE      */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

/**
 * Created by Franck Allimant, CQFDev <franck@cqfdev.fr>
 * Date: 04/09/2019 14:34
 */
namespace ColissimoHomeDelivery\EventListeners;

use ColissimoHomeDelivery\ColissimoHomeDelivery;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Action\BaseAction;
use Thelia\Core\Event\Order\OrderEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\Template\ParserInterface;
use Thelia\Mailer\MailerFactory;
use Thelia\Model\ConfigQuery;

class ShippingNotificationSender extends BaseAction implements EventSubscriberInterface
{
    /** @var MailerFactory */
    protected $mailer;
    /** @var ParserInterface */
    protected $parser;

    public function __construct(ParserInterface $parser, MailerFactory $mailer)
    {
        $this->parser = $parser;
        $this->mailer = $mailer;
    }

    /**
     *
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            TheliaEvents::ORDER_UPDATE_STATUS => ['sendShippingNotification', 128]
        ];
    }

    /**
     * @param OrderEvent $event
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function sendShippingNotification(OrderEvent $event)
    {
        $order = $event->getOrder();
        if ($event->getOrder()->isSent() && $order->getDeliveryModuleId() == ColissimoHomeDelivery::getModuleId()) {
            $contact_email = ConfigQuery::getStoreEmail();

            if ($contact_email) {
                $order = $event->getOrder();
                $customer = $order->getCustomer();

                $this->mailer->sendEmailToCustomer(
                    ColissimoHomeDelivery::CONFIRMATION_MESSAGE_NAME,
                    $order->getCustomer(),
                    [
                        'order_id' => $order->getId(),
                        'order_ref' => $order->getRef(),
                        'customer_id' => $customer->getId(),
                        'order_date' => $order->getCreatedAt(),
                        'update_date' => $order->getUpdatedAt(),
                        'package' => $order->getDeliveryRef()
                    ]
                );
            }
        }
    }
}
