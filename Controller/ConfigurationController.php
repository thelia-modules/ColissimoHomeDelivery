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
 * Date: 17/08/2019 12:26
 */
namespace ColissimoHomeDelivery\Controller;

use ColissimoHomeDelivery\ColissimoHomeDelivery;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Tools\URL;

class ConfigurationController extends BaseAdminController
{
    public function configure()
    {
        if (null !== $response = $this->checkAuth(AdminResources::MODULE, ColissimoHomeDelivery::DOMAIN_NAME, AccessManager::UPDATE)) {
            return $response;
        }

        $configurationForm = $this->createForm('colissimo.homedelivery.configuration.form');

        $message = false;

        $url = '/admin/module/ColissimoHomeDelivery';

        try {
            $form = $this->validateForm($configurationForm);

            // Get the form field values
            $data = $form->getData();

            foreach ($data as $name => $value) {
                if (is_array($value)) {
                    $value = implode(';', $value);
                }

                ColissimoHomeDelivery::setConfigValue($name, $value);
            }

            // Log configuration modification
            $this->adminLogAppend(
                'colissimo.home.delivery.configuration.message',
                AccessManager::UPDATE,
                'ColissimoHomeDelivery configuration updated'
            );

            // Redirect to the success URL,
            if (! $this->getRequest()->get('save_mode') === 'stay') {
                $url = '/admin/modules';
            }
        } catch (FormValidationException $ex) {
            $message = $this->createStandardFormValidationErrorMessage($ex);
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
        }

        if ($message !== false) {
            $this->setupFormErrorContext(
                $this->getTranslator()->trans('ColissimoHomeDelivery configuration', [], ColissimoHomeDelivery::DOMAIN_NAME),
                $message,
                $configurationForm,
                $ex
            );
        }

        return $this->generateRedirect(URL::getInstance()->absoluteUrl($url, [ 'tab' => 'config', 'success' => $message === false ]));
    }
}
