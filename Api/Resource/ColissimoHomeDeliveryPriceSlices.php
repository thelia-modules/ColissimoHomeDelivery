<?php

namespace ColissimoHomeDelivery\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ColissimoHomeDelivery\Model\Map\ColissimoHomeDeliveryPriceSlicesTableMap;
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
            uriTemplate: '/admin/colissimo/price-slices/{id}',
            name: 'api_price_slices_get_id',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/admin/colissimo/price-slices',
            name: 'api_price_slices_get_collection',
            provider: PropelCollectionProvider::class
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_ADMIN_READ]],
    denormalizationContext: ['groups' => [self::GROUP_ADMIN_WRITE]]
)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/front/colissimo/price-slices/{id}',
            name: 'api_price_slices_get_id_front',
            provider: PropelItemProvider::class
        ),
        new GetCollection(
            uriTemplate: '/front/colissimo/price-slices',
            name: 'api_price_slices_get_collection_front',
            provider: PropelCollectionProvider::class
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_FRONT_READ]],
    denormalizationContext: ['groups' => [self::GROUP_FRONT_WRITE]]
)]
class ColissimoHomeDeliveryPriceSlices
{
    public const GROUP_ADMIN_READ = 'admin:colissimo_price_slice:read';
    public const GROUP_ADMIN_WRITE = 'admin:colissimo_price_slice:write';
    public const GROUP_FRONT_READ = 'front:colissimo_price_slice:read';
    public const GROUP_FRONT_WRITE = 'front:colissimo_price_slice:write';

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
    public ?float $maxWeight = null;

    /**
     * @var float|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?float $maxPrice = null;

    /**
     * @var float|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_ADMIN_WRITE, self::GROUP_FRONT_READ])]
    public ?float $shipping = null;

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
    public function getMaxWeight(): ?float
    {
        return $this->maxWeight;
    }

    /**
     * @param float|null $maxWeight
     * @return void
     */
    public function setMaxWeight(?float $maxWeight): void
    {
        $this->maxWeight = $maxWeight;
    }

    /**
     * @return float|null
     */
    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    /**
     * @param float|null $maxPrice
     * @return void
     */
    public function setMaxPrice(?float $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return float|null
     */
    public function getShipping(): ?float
    {
        return $this->shipping;
    }

    /**
     * @param float|null $shipping
     * @return void
     */
    public function setShipping(?float $shipping): void
    {
        $this->shipping = $shipping;
    }

    /**
     * @return TableMap|null
     */
    #[Ignore] public static function getPropelRelatedTableMap(): ?TableMap
    {
        return new ColissimoHomeDeliveryPriceSlicesTableMap();
    }
}
