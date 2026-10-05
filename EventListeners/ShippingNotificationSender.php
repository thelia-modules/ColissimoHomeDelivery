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
use Symfony\Component\HttpFoundation\RequestStack;
use Thelia\Action\BaseAction;
use Thelia\Core\Event\Order\OrderEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Mailer\MailerFactory;
use Thelia\Model\ConfigQuery;
use Thelia\Model\LangQuery;
use Thelia\Model\MessageQuery;

class ShippingNotificationSender extends BaseAction implements EventSubscriberInterface
{
    /** @var MailerFactory */
    protected $mailer;
    /** @var Request */
    protected $request;

    public function __construct(MailerFactory $mailer, RequestStack $requestStack)
    {
        $this->mailer = $mailer;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     *
     * @inheritdoc
     */
    public static function getSubscribedEvents(): array
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

                $message = MessageQuery::create()
                    ->filterByName(ColissimoHomeDelivery::CONFIRMATION_MESSAGE_NAME)
                    ->findOne();

                if (false === $message || null === $message) {
                    throw new \Exception("Failed to load message ".ColissimoHomeDelivery::CONFIRMATION_MESSAGE_NAME.".");
                }

                $order = $event->getOrder();
                $customer = $order->getCustomer();

                // Configured site URL
                $urlSite =  ConfigQuery::read('url_site');

                // for one domain by lang
                if ((int) ConfigQuery::read('one_domain_foreach_lang', 0) === 1) {
                    // We always query the DB here, as the Lang configuration (then the related URL) may change during the
                    // user session lifetime, and improper URLs could be generated. This is quite odd, okay, but may happen.
                    $lang = (null !== $this->request && $this->request->hasSession())
                        ? $this->request->getSession()->getLang()
                        : $order->getLang();
                    $urlSite = LangQuery::create()->findPk($lang->getId())->getUrl();
                }

                $message
                    ->setLocale($order->getLang()->getLocale());

                $this->mailer->sendEmailToCustomer(
                    $message->getName(),
                    $customer,
                    [
                        'order_ref' => $order->getRef(),
                        'order_date' => $order->getCreatedAt(),
                        'update_date' => $order->getUpdatedAt(),
                        'package' => $order->getDeliveryRef(),
                        'store_name' => ConfigQuery::read('store_name'),
                        'store_url' => $urlSite,
                    ]
                );
            }
        }
    }
}