<?php
/*************************************************************************************/
/*      Copyright (c) Franck Allimant, CQFDev                                        */
/*      email : thelia@cqfdev.fr                                                     */
/*      web : http://www.cqfdev.fr                                                   */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE      */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace ColissimoHomeDelivery\Hook;

use ColissimoHomeDelivery\ColissimoHomeDelivery;
use ColissimoHomeDelivery\Form\ConfigurationForm;
use ColissimoHomeDelivery\Form\FreeShippingForm;
use ColissimoHomeDelivery\Form\TaxRuleForm;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryAreaFreeshippingQuery;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryFreeshipping;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryFreeshippingQuery;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlicesQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Symfony\Component\Form\FormView;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Form\TheliaFormFactory;
use Thelia\Core\Hook\BaseHook;
use Thelia\Core\Template\Parser\ParserResolver;
use Thelia\Model\AreaQuery;
use Thelia\Model\ModuleConfig;
use Thelia\Model\ModuleConfigQuery;

class HookManager extends BaseHook
{
    public function __construct(
        private readonly TheliaFormFactory $formFactory,
        ?EventDispatcherInterface $dispatcher = null,
        ?ParserResolver $parserResolver = null,
    ) {
        parent::__construct($dispatcher, $parserResolver);
    }

    public static function getSubscribedHooks(): array
    {
        return [
            'module.configuration' => [
                ['type' => 'back', 'method' => 'onModuleConfigure'],
            ],
            'module.config-js' => [
                ['type' => 'back', 'method' => 'onModuleConfigJs'],
            ],
        ];
    }

    public function onModuleConfigure(HookRenderEvent $event): void
    {
        $vars = [];

        if (null !== $params = ModuleConfigQuery::create()->findByModuleId(ColissimoHomeDelivery::getModuleId())) {
            /** @var ModuleConfig $param */
            foreach ($params as $param) {
                $vars[$param->getName()] = $param->getValue();
            }
        }

        $locale = $this->getCurrentLocale();

        // Ensure the freeshipping row (id=1) exists before forms read it.
        $vars['freeshipping'] = $this->getFreeshipping();

        $vars['configuration_form'] = $this->buildFormView(ConfigurationForm::getName());
        $vars['freeshipping_form'] = $this->buildFormView(FreeShippingForm::getName());
        $vars['tax_rule_form'] = $this->buildFormView(TaxRuleForm::getName());

        $vars['areas'] = $this->getAreasWithSlices($locale);

        $event->add(
            $this->render('ColissimoHomeDelivery/module_configuration.html.twig', $vars)
        );
    }

    public function onModuleConfigJs(HookRenderEvent $event): void
    {
        $event->add($this->render('ColissimoHomeDelivery/module-config-js.html.twig'));
    }

    private function buildFormView(string $formName): FormView
    {
        return $this->formFactory->createForm($formName)->getForm()->createView();
    }

    private function getCurrentLocale(): string
    {
        $request = $this->getRequest();
        $lang = (null !== $request && $request->hasSession()) ? $request->getSession()->getAdminEditionLang() : null;

        return $lang?->getLocale() ?? 'en_US';
    }

    /**
     * @return array{active: bool, from: float|string|null}
     */
    private function getFreeshipping(): array
    {
        $freeshipping = ColissimoHomeDeliveryFreeshippingQuery::create()->findOneById(1);

        if (null === $freeshipping) {
            $freeshipping = (new ColissimoHomeDeliveryFreeshipping())->setId(1)->setActive(0);
            $freeshipping->save();
        }

        return [
            'active' => (bool) $freeshipping->getActive(),
            'from' => $freeshipping->getFreeshippingFrom(),
        ];
    }

    /**
     * Areas assigned to this delivery module, with their price slices and area free-shipping threshold.
     *
     * @return array<int, array{id: int, name: string, cart_amount: float|string|null, slices: array<int, array{id: int, max_weight: float|string|null, max_price: float|string|null, shipping: float|string|null}>}>
     */
    private function getAreasWithSlices(string $locale): array
    {
        $moduleId = ColissimoHomeDelivery::getModuleId();

        $areas = AreaQuery::create()
            ->useAreaDeliveryModuleQuery()
                ->filterByDeliveryModuleId([$moduleId], Criteria::IN)
            ->endUse()
            ->find();

        $result = [];

        foreach ($areas as $area) {
            $areaId = $area->getId();

            $slices = [];
            $priceSlices = ColissimoHomeDeliveryPriceSlicesQuery::create()
                ->filterByAreaId($areaId)
                ->orderByMaxWeight()
                ->orderByMaxPrice()
                ->find();

            foreach ($priceSlices as $slice) {
                $slices[] = [
                    'id' => $slice->getId(),
                    'max_weight' => $slice->getMaxWeight(),
                    'max_price' => $slice->getMaxPrice(),
                    'shipping' => $slice->getShipping(),
                ];
            }

            $areaFreeshipping = ColissimoHomeDeliveryAreaFreeshippingQuery::create()
                ->filterByAreaId($areaId)
                ->findOne();

            $result[] = [
                'id' => $areaId,
                'name' => $area->getName(),
                'cart_amount' => $areaFreeshipping?->getCartAmount(),
                'slices' => $slices,
            ];
        }

        return $result;
    }
}
