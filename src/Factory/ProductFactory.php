<?php

namespace App\Factory;

use App\BackOffice\Products\Domain\Model\Product;
use App\BackOffice\Products\Domain\ValueObject\Price;
use App\BackOffice\Products\Domain\ValueObject\ProductDescription;
use App\BackOffice\Products\Domain\ValueObject\ProductName;
use App\BackOffice\Products\Domain\ValueObject\Tax;
use App\BackOffice\Products\Domain\Enums\Tax as TaxEnum;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Product>
 *
 * @method        Product|Proxy                     create(array|callable $attributes = [])
 * @method static Product|Proxy                     createOne(array $attributes = [])
 * @method static Product|Proxy                     find(object|array|mixed $criteria)
 * @method static Product|Proxy                     findOrCreate(array $attributes)
 * @method static Product|Proxy                     first(string $sortedField = 'id')
 * @method static Product|Proxy                     last(string $sortedField = 'id')
 * @method static Product|Proxy                     random(array $attributes = [])
 * @method static Product|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ProductRepository|RepositoryProxy repository()
 * @method static Product[]|Proxy[]                 all()
 * @method static Product[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Product[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Product[]|Proxy[]                 findBy(array $attributes)
 * @method static Product[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Product[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ProductFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => new ProductName(self::faker()->text(20)),
            'description' => new ProductDescription(self::faker()->text(255)),
            'price' => new Price(self::faker()->randomDigitNotNull()),
            'tax' => new Tax(self::faker()->randomElement([TaxEnum::LOW, TaxEnum::MEDIUM, TaxEnum::HIGH])),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
             ->afterInstantiate(function(Product $product): void {
                 $product->calculateTotal();
             })
        ;
    }

    protected static function getClass(): string
    {
        return Product::class;
    }
}
