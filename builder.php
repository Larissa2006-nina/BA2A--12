<?php
/**
 * Builder Pattern Example in PHP
 * - Product: House
 * - Builder: HouseBuilder (interface)
 * - Concrete Builders: IglooBuilder, StoneHouseBuilder
 * - Director: Director
 *
 * This file is self-contained and prints two example houses when run.
 */

// Product
class House
{
    public $basement = '';
    public $structure = '';
    public $roof = '';
    public $interior = '';

    public function describe(): string
    {
        return sprintf(
            "House (basement: %s, structure: %s, roof: %s, interior: %s)",
            $this->basement,
            $this->structure,
            $this->roof,
            $this->interior
        );
    }
}

// Builder Interface
interface HouseBuilder
{
    public function buildBasement();
    public function buildStructure();
    public function buildRoof();
    public function buildInterior();
    public function getHouse(): House;
}

// Concrete Builder 1
class IglooBuilder implements HouseBuilder
{
    private $house;

    public function __construct()
    {
        $this->house = new House();
    }

    public function buildBasement()
    {
        $this->house->basement = 'Ice bars';
    }

    public function buildStructure()
    {
        $this->house->structure = 'Ice blocks';
    }

    public function buildRoof()
    {
        $this->house->roof = 'Ice dome';
    }

    public function buildInterior()
    {
        $this->house->interior = 'Ice carvings';
    }

    public function getHouse(): House
    {
        return $this->house;
    }
}

// Concrete Builder 2
class StoneHouseBuilder implements HouseBuilder
{
    private $house;

    public function __construct()
    {
        $this->house = new House();
    }

    public function buildBasement()
    {
        $this->house->basement = 'Concrete foundation';
    }

    public function buildStructure()
    {
        $this->house->structure = 'Stone walls';
    }

    public function buildRoof()
    {
        $this->house->roof = 'Wooden roof';
    }

    public function buildInterior()
    {
        $this->house->interior = 'Plastered interior with heating';
    }

    public function getHouse(): House
    {
        return $this->house;
    }
}

// Director
class Director
{
    private $builder;

    public function setBuilder(HouseBuilder $builder)
    {
        $this->builder = $builder;
    }

    // A minimal viable house
    public function buildMinimalViableHouse()
    {
        $this->builder->buildBasement();
        $this->builder->buildStructure();
    }

    // A full featured house
    public function buildFullFeaturedHouse()
    {
        $this->builder->buildBasement();
        $this->builder->buildStructure();
        $this->builder->buildRoof();
        $this->builder->buildInterior();
    }
}

// === Usage demo ===
function main()
{
    $director = new Director();

    // Build a minimal igloo
    $iglooBuilder = new IglooBuilder();
    $director->setBuilder($iglooBuilder);
    $director->buildMinimalViableHouse();
    $minimalIgloo = $iglooBuilder->getHouse();
    echo "Minimal Igloo:\n" . $minimalIgloo->describe() . "\n\n";

    // Build a full stone house
    $stoneBuilder = new StoneHouseBuilder();
    $director->setBuilder($stoneBuilder);
    $director->buildFullFeaturedHouse();
    $fullStoneHouse = $stoneBuilder->getHouse();
    echo "Full Stone House:\n" . $fullStoneHouse->describe() . "\n";

    // Direct custom build without director (fluent/step-by-step)
    $custom = new StoneHouseBuilder();
    $custom->buildBasement();
    $custom->buildStructure();
    // skip roof and interior to create a half-done house
    echo "Custom (step-by-step) Stone House:\n" . $custom->getHouse()->describe() . "\n";
}

main();