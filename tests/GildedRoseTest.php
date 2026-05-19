<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testNormalItemQualityDecreasesByOne(): void{
        $items = [new Item('normal Item', 10, 20)];
        
        $app = new GildedRose($items);
        $app->updateQuality();

        $this->assertSame(9, $items[0]->sellIn);
        $this->assertSame(19, $items[0]->quality);
    }

    public function testNormalItemQualityDecreasesTwiceAsFastAfterSellDate(): void{
        $items = [new Item('normal Item', 0, 20)];
        
        $app = new GildedRose($items);
        $app->updateQuality();

        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(18, $items[0]->quality);
    }

    public function testQualityNeverDropsBelowZero(): void{
        $items = [new Item('normal item', 10, 0)];
        
        $app = new GildedRose($items);
        $app->updateQuality();

        $this->assertSame(0, $items[0]->quality);
    }

    public function testAgedBrieQualityIncreases(): void{
        $items = [new Item('Aged Brie', 2, 0)];
        
        $app = new GildedRose($items);
        $app->updateQuality();

        $this->assertSame(1, $items[0]->sellIn);
        $this->assertSame(1, $items[0]->quality);
    }

    public function testQualityNeverGoesAboveFifty(): void{
        $items = [new Item('Aged Brie', 2, 50)];
        
        $app = new GildedRose($items);
        $app->updateQuality();

        $this->assertSame(50, $items[0]->quality);
    }

    public function testSulfurasNeverChanges(): void{
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 80)];
        
        $app = new GildedRose($items);
        $app->updateQuality();

        $this->assertSame(0, $items[0]->sellIn);
        $this->assertSame(80, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseByTwoWhenTenDaysOrLess(): void{
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20)];
        
        $app = new GildedRose($items);
        $app->updateQuality();

        $this->assertSame(9, $items[0]->sellIn);
        $this->assertSame(22, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseByThreeWhenFiveDaysOrLess(): void{
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20)];
        
        $app = new GildedRose($items);
        $app->updateQuality();

        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(23, $items[0]->quality);
    }

    public function testBackstagePassesQualityDropsToZeroAfterConcert(): void{
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20)];
        
        $app = new GildedRose($items);
        $app->updateQuality();

        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

}
