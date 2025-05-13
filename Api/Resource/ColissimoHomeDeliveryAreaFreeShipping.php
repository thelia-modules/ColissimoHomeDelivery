<?php

namespace ColissimoHomeDelivery\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ColissimoHomeDelivery\Model\Map\ColissimoHomeDeliveryAreaFreeShippingTableMap;
use Propel\Runtime\Map\TableMap;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Thelia\Api\Bridge\Propel\Attribute\Relation;
use Thelia\Api\Bridge\Propel\State\PropelCollectionProvider;
use Thelia\Api\Bridge\Propel\State\PropelItemProvider;
use Thelia\Model\Area;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/admin/colissimo/area-free-shipping/{id}',
            name: 'api_colissimo_area_freeshipping_get_id',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/admin/colissimo/area-free-shipping',
            name: 'api_colissimo_area_freeshipping_get_collection',
            provider: PropelCollectionProvider::class
        )
    ],
    normalizationContext: ['groups' => [self::GROUP_ADMIN_READ]],
    denormalizationContext: ['groups' => [self::GROUP_ADMIN_WRITE]]
)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/front/colissimo/area-free-shipping/{id}',
            name: 'api_colissimo_area_freeshipping_get_id_front',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/front/colissimo/area-free-shipping',
            name: 'api_colissimo_area_freeshipping_get_collection_front',
            provider: PropelCollectionProvider::class
        )
    ],
    normalizationContext: ['groups' => [self::GROUP_FRONT_READ]],
    denormalizationContext: ['groups' => [self::GROUP_FRONT_WRITE]]
)]
class ColissimoHomeDeliveryAreaFreeShipping
{
    public const GROUP_ADMIN_READ = 'admin:colissimo_area_freeshipping:read';
    public const GROUP_ADMIN_WRITE = 'admin:colissimo_area_freeshipping:write';
    public const GROUP_FRONT_READ = 'front:colissimo_area_freeshipping:read';
    public const GROUP_FRONT_WRITE = 'front:colissimo_area_freeshipping:write';

    /**
     * @var int|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?int $id = null;

    /**
     * @var Area|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    #[Relation(targetResource: Area::class)]
    public ?Area $area = null;

    /**
     * @var float|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?float $cartAmount = null;

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
     * @return Area|null
     */
    public function getArea(): ?Area
    {
        return $this->area;
    }

    /**
     * @param Area|null $area
     * @return void
     */
    public function setArea(?Area $area): void
    {
        $this->area = $area;
    }

    /**
     * @return float|null
     */
    public function getCartAmount(): ?float
    {
        return $this->cartAmount;
    }

    /**
     * @param float|null $cartAmount
     * @return void
     */
    public function setCartAmount(?float $cartAmount): void
    {
        $this->cartAmount = $cartAmount;
    }

    /**
     * @return TableMap|null
     */
    #[Ignore]
    public static function getPropelRelatedTableMap(): ?TableMap
    {
        return new ColissimoHomeDeliveryAreaFreeShippingTableMap();
    }
}
