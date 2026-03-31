<?php


namespace ColissimoHomeDelivery\Loop;


use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryAreaFreeshipping;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryAreaFreeshippingQuery;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;

class ColissimoHomeDeliveryAreaFreeShippingLoop extends BaseLoop implements PropelSearchLoopInterface
{
    /**
     * @return ArgumentCollection
     */
    protected function getArgDefinitions(): ArgumentCollection
    {
        return new ArgumentCollection(
            Argument::createIntTypeArgument('area_id')
        );
    }

    public function buildModelCriteria(): ColissimoHomeDeliveryAreaFreeshippingQuery
    {
        $areaId = $this->getAreaId();

        $search = ColissimoHomeDeliveryAreaFreeshippingQuery::create();

        if (null !== $areaId) {
            $search->filterByAreaId($areaId);
        }

        return $search;
    }

    public function parseResults(LoopResult $loopResult): LoopResult
    {
        /** @var ColissimoHomeDeliveryAreaFreeshipping $mode */
        foreach ($loopResult->getResultDataCollection() as $mode) {
            $loopResultRow = new LoopResultRow($mode);
            $loopResultRow
                ->set("ID", $mode->getId())
                ->set("AREA_ID", $mode->getAreaId())
                ->set("CART_AMOUNT", $mode->getCartAmount());
            $loopResult->addRow($loopResultRow);
        }
        return $loopResult;
    }
}
