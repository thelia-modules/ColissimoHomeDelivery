# ColissimoHomeDelivery

Adds a delivery system for Colissimo Domicile delivery, with or without signature.    
For pickup delivery look at this module https://github.com/thelia-modules/ColissimoPickupPoint

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is ReadmeTest.
* Activate it in your thelia administration panel

### Composer

Add it in your main thelia composer.json file

```
composer require thelia/colissimo-home-delivery-module:~2.0
```

## Usage

From the module configuration tab :

- Price slice tab : Allow you to define price slices for every area served by your module, as well as to toggle free shipping, 
for a minimum price, minimum price by area, or for everyone.
- Configuration tab : Lets you configure your module

## Loop

If your module declare one or more loop, describe them here like this :

[colissimo.homedelivery.price-slices]

### Input arguments

|Argument |Description |
|---      |--- |
|**area_id** | Mandatory. The ID of an area served by your module |

### Output arguments

|Variable   |Description |
|---        |--- |
|$SLICE_ID    | The price slice ID |
|$MAX_WEIGHT    | The max weight for this price slice |
|$MAX_PRICE    | The max cart price for this price slice |
|$SHIPPING    | The shipping cost for this price slice |

[colissimo.homedelivery.freeshipping]

### Input arguments

|Argument |Description |
|---      |--- |
|**id** | The entry ID in the table. It should always be 1 |

### Output arguments

|Variable   |Description |
|---        |--- |
|$FREESHIPPING_ACTIVE | (bool) Whether the global freeshipping without restrictions is activated or not |
|$FREESHIPPING_FROM | The minimum cart amount to have a global freeshipping |

[colissimo.homedelivery.area.freeshipping]

### Input arguments

|Argument |Description |
|---      |--- |
|**area_id** | The ID of an area served by your module |

### Output arguments

|Variable   |Description |
|---        |--- |
|$ID    | The entry ID in the table |
|$AREA_ID    | The area ID |
|$CART_AMOUNT    | The cart amount necessary to benefit from free delivery for this area |


