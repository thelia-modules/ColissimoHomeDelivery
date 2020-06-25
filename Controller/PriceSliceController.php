<?php


namespace ColissimoHomeDelivery\Controller;



use ColissimoHomeDelivery\ColissimoHomeDelivery;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlices;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryPriceSlicesQuery;
use Propel\Runtime\Map\TableMap;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;

class PriceSliceController extends BaseAdminController
{
    protected function getFloatVal($val, $default = -1)
    {
        if (preg_match("#^([0-9\.,]+)$#", $val, $match)) {
            $val = $match[0];
            if (strstr($val, ",")) {
                $val = str_replace(".", "", $val);
                $val = str_replace(",", ".", $val);
            }
            $val = (float)$val;

            return $val;
        }

        return $default;
    }

    public function savePriceSliceAction()
    {
        $response = $this->checkAuth([], ['colissimohomedelivery'], AccessManager::UPDATE);

        if (null !== $response) {
            return $response;
        }

        $this->checkXmlHttpRequest();

        $responseData = [
            'success' => false,
            'message' => '',
            'slice' => null
        ];

        $messages = [];
        $response = null;

        try {
            $requestData = $this->getRequest()->request;

            if (0 !== $id = (int)$requestData->get('id', 0)) {
                $slice = ColissimoHomeDeliveryPriceSlicesQuery::create()->findPk($id);
            } else {
                $slice = new ColissimoHomeDeliveryPriceSlices();
            }


            if (0 !== $areaId = (int)$requestData->get('area', 0)) {
                $slice->setAreaId($areaId);
            } else {
                $messages[] = $this->getTranslator()->trans(
                    'The area is not valid',
                    [],
                    ColissimoHomeDelivery::DOMAIN_NAME
                );
            }

            $requestPriceMax = $requestData->get('maxPrice', null);
            $requestmaxWeight = $requestData->get('maxWeight', null);

            if (empty($requestPriceMax) && empty($requestmaxWeight)) {
                $messages[] = $this->getTranslator()->trans(
                    'You must specify at least a price max or a weight max value.',
                    [],
                    ColissimoHomeDelivery::DOMAIN_NAME
                );
            } else {
                if (!empty($requestPriceMax)) {
                    $maxPrice = $this->getFloatVal($requestPriceMax);
                    if (0 < $maxPrice) {
                        $slice->setMaxPrice($maxPrice);
                    } else {
                        $messages[] = $this->getTranslator()->trans(
                            'The price max value is not valid',
                            [],
                            ColissimoHomeDelivery::DOMAIN_NAME
                        );
                    }
                } else {
                    $slice->setMaxPrice(null);
                }

                if (!empty($requestmaxWeight)) {
                    $maxWeight = $this->getFloatVal($requestmaxWeight);
                    if (0 < $maxWeight) {
                        $slice->setMaxWeight($maxWeight);
                    } else {
                        $messages[] = $this->getTranslator()->trans(
                            'The weight max value is not valid',
                            [],
                            ColissimoHomeDelivery::DOMAIN_NAME
                        );
                    }
                } else {
                    $slice->setMaxWeight(null);
                }
            }



            $price = $this->getFloatVal($requestData->get('shipping', 0));
            if (0 <= $price) {
                $slice->setShipping($price);
            } else {
                $messages[] = $this->getTranslator()->trans(
                    'The price value is not valid',
                    [],
                    ColissimoHomeDelivery::DOMAIN_NAME
                );
            }

            if (0 === count($messages)) {
                $slice->save();
                $messages[] = $this->getTranslator()->trans(
                    'Your slice has been saved',
                    [],
                    ColissimoHomeDelivery::DOMAIN_NAME
                );

                $responseData['success'] = true;
                $responseData['slice'] = $slice->toArray(TableMap::TYPE_STUDLYPHPNAME);
            }
        } catch (\Exception $e) {
            $message[] = $e->getMessage();
        }

        $responseData['message'] = $messages;

        return $this->jsonResponse(json_encode($responseData));
    }

    public function deletePriceSliceAction()
    {
        $response = $this->checkAuth([], ['colissimohomedelivery'], AccessManager::DELETE);

        if (null !== $response) {
            return $response;
        }

        $this->checkXmlHttpRequest();

        $responseData = [
            'success' => false,
            'message' => '',
            'slice' => null
        ];

        $response = null;

        try {
            $requestData = $this->getRequest()->request;

            if (0 !== $id = (int)$requestData->get('id', 0)) {
                $priceSlice = ColissimoHomeDeliveryPriceSlicesQuery::create()->findPk($id);
                $priceSlice->delete();
                $responseData['success'] = true;
            } else {
                $responseData['message'] = $this->getTranslator()->trans(
                    'The slice has not been deleted',
                    [],
                    ColissimoHomeDelivery::DOMAIN_NAME
                );
            }
        } catch (\Exception $e) {
            $responseData['message'] = $e->getMessage();
        }

        return $this->jsonResponse(json_encode($responseData));
    }
}