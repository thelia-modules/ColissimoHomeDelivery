<?php
/*************************************************************************************/
/*                                                                                   */
/*      Thelia                                                                       */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : info@thelia.net                                                      */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      This program is free software; you can redistribute it and/or modify         */
/*      it under the terms of the GNU General Public License as published by         */
/*      the Free Software Foundation; either version 3 of the License                */
/*                                                                                   */
/*      This program is distributed in the hope that it will be useful,              */
/*      but WITHOUT ANY WARRANTY; without even the implied warranty of               */
/*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                */
/*      GNU General Public License for more details.                                 */
/*                                                                                   */
/*      You should have received a copy of the GNU General Public License            */
/*      along with this program. If not, see <http://www.gnu.org/licenses/>.         */
/*                                                                                   */
/*************************************************************************************/

namespace ColissimoHomeDelivery\Controller;

use ColissimoHomeDelivery\Form\FreeShippingForm;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryAreaFreeshippingQuery;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryFreeshipping;
use ColissimoHomeDelivery\Model\ColissimoHomeDeliveryFreeshippingQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Thelia\Controller\Admin\BaseAdminController;

use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Security\AccessManager;
use Thelia\Model\AreaQuery;
use Thelia\Tools\URL;

class FreeShippingController extends BaseAdminController
{
    public function toggleFreeShippingActivation()
    {
        if (null !== $response = $this
                ->checkAuth(array(AdminResources::MODULE), array('ColissimoHomeDelivery'), AccessManager::UPDATE)) {
            return $response;
        }

        $form = $this->createForm(FreeShippingForm::getName());
        $response = null;

        try {
            $vform = $this->validateForm($form);
            $freeshipping = $vform->get('freeshipping')->getData();
            $freeshippingFrom = $vform->get('freeshipping_from')->getData();

            if (null === $isFreeShippingActive = ColissimoHomeDeliveryFreeshippingQuery::create()->findOneById(1)){
                $isFreeShippingActive = new ColissimoHomeDeliveryFreeshipping();
            }

            $isFreeShippingActive
                ->setActive($freeshipping)
                ->setFreeshippingFrom($freeshippingFrom)
            ;
            $isFreeShippingActive->save();

            $response = $this->generateRedirectFromRoute(
                'admin.module.configure',
                array(),
                array (
                    'current_tab'=> 'prices_slices_tab',
                    'module_code'=> 'ColissimoHomeDelivery',
                    '_controller' => 'Thelia\\Controller\\Admin\\ModuleController::configureAction',
                    'price_error_id' => null,
                    'price_error' => null
                )
            );
        } catch (\Exception $e) {
            $response = JsonResponse::create(array('error' => $e->getMessage()), 500);
        }
        return $response;
    }

    /**
     * @return mixed|Response|null
     */
    public function setAreaFreeShipping()
    {
        if (null !== $response = $this
                ->checkAuth(array(AdminResources::MODULE), array('ColissimoHomeDelivery'), AccessManager::UPDATE)) {
            return $response;
        }

        try {
            $data = $this->getRequest()->request;

            $colissimo_homedelivery_area_id = $data->get('area-id');
            $cartAmount = $data->get('cart-amount');

            if ($cartAmount < 0 || $cartAmount === '') {
                $cartAmount = null;
            }

            $areaQuery = AreaQuery::create()->findOneById($colissimo_homedelivery_area_id);
            if (null === $areaQuery) {
                return null;
            }

            $colissimoHomeDeliveryAreaFreeshippingQuery = ColissimoHomeDeliveryAreaFreeshippingQuery::create()
                ->filterByAreaId($colissimo_homedelivery_area_id)
                ->findOneOrCreate();

            $colissimoHomeDeliveryAreaFreeshippingQuery
                ->setAreaId($colissimo_homedelivery_area_id)
                ->setCartAmount($cartAmount)
                ->save();

        } catch (\Exception $e) {
        }

        return $this->generateRedirect(URL::getInstance()->absoluteUrl('/admin/module/ColissimoHomeDelivery'));
    }

}
