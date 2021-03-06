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
namespace ColissimoHomeDelivery\Form;

use ColissimoHomeDelivery\ColissimoHomeDelivery;
use SimpleDhl\SimpleDhl;
use Symfony\Component\Validator\Constraints\NotBlank;
use Thelia\Form\BaseForm;

class ConfigurationForm extends BaseForm
{
    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                ColissimoHomeDelivery::COLISSIMO_USERNAME,
                'text',
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                    'label'       => $this->translator->trans('Colissimo username', [], ColissimoHomeDelivery::DOMAIN_NAME),
                    'label_attr'  => [
                        'help' => $this->translator->trans(
                            'Nom d\'utilisateur Colissimo. C\'est l\'identifiants qui vous permet d’accéder à votre espace client à l\'adresse https://www.colissimo.fr/entreprise',
                            [],
                            ColissimoHomeDelivery::DOMAIN_NAME
                        )
                    ]
                ]
            )
            ->add(
                ColissimoHomeDelivery::COLISSIMO_PASSWORD,
                'text',
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                    'label'       => $this->translator->trans('Colissimo password', [], ColissimoHomeDelivery::DOMAIN_NAME),
                    'label_attr'  => [
                        'help' => $this->translator->trans(
                            'Le mot de passe qui vous permet d’accéder à votre espace client à l\'adresse https://www.colissimo.fr/entreprise',
                            [],
                            ColissimoHomeDelivery::DOMAIN_NAME
                        )
                    ]
                ]
            )
            ->add(
                ColissimoHomeDelivery::AFFRANCHISSEMENT_ENDPOINT_URL,
                'url',
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                    'label'       => $this->translator->trans('Endpoint du web service d\'affranchissement', [], ColissimoHomeDelivery::DOMAIN_NAME),
                    'label_attr'  => [
                        'help' => $this->translator->trans(
                            'Indiquez le endpoint de base à utiliser, par exemple https://domain.tld/transactionaldata/api/v1',
                            [],
                            ColissimoHomeDelivery::DOMAIN_NAME
                        )
                    ]
                ]
            )
            ->add(
                ColissimoHomeDelivery::ACTIVATE_DETAILED_DEBUG,
                'checkbox',
                [
                    'required' => false,
                    'label'       => $this->translator->trans('Activer les logs détaillés', [], ColissimoHomeDelivery::DOMAIN_NAME),
                    'label_attr'  => [
                        'help' => $this->translator->trans(
                            'Si cette case est cochée, le texte complet des requêtes et des réponses figurera dans le log Thelia',
                            [],
                            ColissimoHomeDelivery::DOMAIN_NAME
                        )
                    ]
                ]
            )
        ;
    }
}
