<?php

namespace ColissimoHomeDelivery\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ColissimoHomeDelivery\Model\Map\ColissimoHomeDeliveryFreeshippingTableMap;
use Propel\Runtime\Map\TableMap;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Thelia\Api\Bridge\Propel\State\PropelCollectionProvider;
use Thelia\Api\Bridge\Propel\State\PropelItemProvider;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/admin/colissimo/free-shipping/{id}',
            name: 'api_colissimo_freeshipping_get_id',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/admin/colissimo/free-shipping',
            name: 'api_colissimo_freeshipping_get_collection',
            provider: PropelCollectionProvider::class
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_ADMIN_READ]],
    denormalizationContext: ['groups' => [self::GROUP_ADMIN_WRITE]]
)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/front/colissimo/free-shipping/{id}',
            name: 'api_colissimo_freeshipping_get_id_front',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/front/colissimo/free-shipping',
            name: 'api_colissimo_freeshipping_get_collection_front',
            provider: PropelCollectionProvider::class
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_FRONT_READ]],
    denormalizationContext: ['groups' => [self::GROUP_FRONT_WRITE]]
)]
class ColissimoHomeDeliveryFreeShipping
{
    public const GROUP_ADMIN_READ = 'admin:colissimo_freeshipping:read';
    public const GROUP_ADMIN_WRITE = 'admin:colissimo_freeshipping:write';
    public const GROUP_FRONT_READ = 'front:colissimo_freeshipping:read';
    public const GROUP_FRONT_WRITE = 'front:colissimo_freeshipping:write';

    /**
     * @var int|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?int $id = null;

    /**
     * @var bool|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?bool $active = null;

    /**
     * @var float|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?float $freeshippingFrom = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool|null $active
     * @return void
     */
    public function setActive(?bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return float|null
     */
    public function getFreeshippingFrom(): ?float
    {
        return $this->freeshippingFrom;
    }

    /**
     * @param float|null $freeshippingFrom
     * @return void
     */
    public function setFreeshippingFrom(?float $freeshippingFrom): void
    {
        $this->freeshippingFrom = $freeshippingFrom;
    }

    /**
     * @return TableMap|null
     */
    #[Ignore] public static function getPropelRelatedTableMap(): ?TableMap
    {
        return new ColissimoHomeDeliveryFreeshippingTableMap();
    }
}
