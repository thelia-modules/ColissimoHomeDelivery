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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Thelia\Form\BaseForm;

class ConfigurationForm extends BaseForm
{
    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                ColissimoHomeDelivery::COLISSIMO_USERNAME,
                TextType::class,
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
                PasswordType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                    'label'       => $this->translator->trans('Colissimo password', [], ColissimoHomeDelivery::DOMAIN_NAME),
                    'data'        => ColissimoHomeDelivery::getConfigValue(ColissimoHomeDelivery::COLISSIMO_PASSWORD),
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
                UrlType::class,
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
                CheckboxType::class,
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

    /**
    * @return string the name of you form. This name must be unique
    */
    public static function getName()
    {
        return "colissimohomedelivery_form_configuration_form";
    }
}
