<?php


namespace ColissimoHomeDelivery\Loop;


use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlicesQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;

class PriceSlicesLoop extends BaseLoop implements PropelSearchLoopInterface
{
    /**
     * @return ArgumentCollection
     */
    protected function getArgDefinitions(): ArgumentCollection
    {
        return new ArgumentCollection(
            Argument::createIntTypeArgument('area_id', null, true)
        );
    }

    /**
     * @param LoopResult $loopResult
     * @return LoopResult
     */
    public function parseResults(LoopResult $loopResult): LoopResult
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

    /**
     * @return ModelCriteria
     */
    public function buildModelCriteria(): ModelCriteria
    {
        $areaId = $this->getAreaId();

        $areaPrices = ColissimoHomeDeliveryPriceSlicesQuery::create()
            ->filterByAreaId($areaId)
            ->orderByMaxWeight()
            ->orderByMaxPrice()
        ;

        return $areaPrices;
    }
}
