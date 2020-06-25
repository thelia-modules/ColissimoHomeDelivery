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
 * Date: 17/08/2019 14:34
 */
namespace ColissimoHomeDelivery\Hook;

use ColissimoHomeDelivery\ColissimoHomeDelivery;
use ColissimoHomeDelivery\Model\ColissimowsLabelQuery;
use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Model\ModuleConfig;
use Thelia\Model\ModuleConfigQuery;
use Thelia\Tools\URL;

class HookManager extends BaseHook
{
    public function onModuleConfigure(HookRenderEvent $event)
    {
        $vars = [ ];

        if (null !== $params = ModuleConfigQuery::create()->findByModuleId(ColissimoHomeDelivery::getModuleId())) {

            /** @var ModuleConfig $param */
            foreach ($params as $param) {
                $vars[ $param->getName() ] = $param->getValue();
            }
        }

        $event->add(
            $this->render(
                'module_configuration.html',
                $vars
            )
        );
    }

    public function onModuleConfigJs(HookRenderEvent $event)
    {
        $event->add($this->render('module-config-js.html'));
    }

}
