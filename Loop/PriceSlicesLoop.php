<?php


namespace ColissimoHomeDelivery\Loop;


use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlicesQuery;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use function mysql_xdevapi\getSession;

class PriceSlicesLoop extends BaseLoop implements PropelSearchLoopInterface
{
    /**
     * @return ArgumentCollection
     */
    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntTypeArgument('area_id', null, true)
        );
    }

    public function buildModelCriteria()
    {
        $areaId = $this->getAreaId();

        $areaPrices = ColissimoHomeDeliveryPriceSlicesQuery::create()
            ->filterByAreaId($areaId)
            ->orderByMaxWeight()
            ->orderByMaxPrice()
        ;

        return $areaPrices;
    }

    public function parseResults(LoopResult $loopResult)
    {
        /** @var \ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlices $priceSlice */
        foreach ($loopResult->getResultDataCollection() as $priceSlice) {
            $loopResultRow = new LoopResultRow($priceSlice);
            $loopResultRow
                ->set('SLICE_ID', $priceSlice->getId())
                ->set('MAX_WEIGHT', $priceSlice->getMaxWeight())
                ->set('MAX_PRICE', $priceSlice->getMaxPrice())
                ->set('SHIPPING', $priceSlice->getShipping())
            ;
            $loopResult->addRow($loopResultRow);
        }
        return $loopResult;
    }
}