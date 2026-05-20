<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    private const AGED_BRIE = 'Aged Brie';
    private const BACKSTAGE_PASS = 'Backstage passes to a TAFKAL80ETC concert';
    private const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    private const CONJURED = 'Conjured Mana Cake';

    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->updateItemBeforeSellInChange($item);
            $this->decreaseSellIn($item);

            if ($item->sellIn < 0) {
                $this->updateExpiredItem($item);
            }
        }
    }

    private function decreaseQuality(Item $item): void
    {
        if($item->quality > 0 ){
            $item->quality--;
        }
    }

    private function increaseQuality(Item $item): void
    {
        if($item->quality < 50 ){
            $item->quality++;
        }
    }

    private function decreaseSellIn(Item $item): void
    {
        if(!$this->isSulfuras($item)){
            $item->sellIn--;
        }
    }

    private function isAgedBrie(Item $item): bool
    {
        return $item->name === self::AGED_BRIE;
    }

    private function isBackstagePass(Item $item): bool
    {
        return $item->name === self::BACKSTAGE_PASS;
    }

    private function isSulfuras(Item $item): bool
    {
        return $item->name === self::SULFURAS;
    }

    private function isConjured(Item $item): bool
    {
        return $item->name === self::CONJURED;
    }

    private function updateConjured(Item $item): void
    {
        $this->decreaseQuality($item);
        $this->decreaseQuality($item);
    }

    private function updateBackstagePass(Item $item): void
    {
        $this->increaseQuality($item);
        
        if ($item->sellIn < 11) {
            $this->increaseQuality($item);
        }
        if ($item->sellIn < 6) {
            $this->increaseQuality($item);
        }
    }

    private function updateExpiredItem(Item $item): void
    {
        if($this->isAgedBrie($item)){
            $this->increaseQuality($item);
            return;
        }
        
        if ($this->isBackstagePass($item)) {
            $item->quality = 0;
            return;
        }

        if($this->isConjured($item)){
            $this->updateConjured($item);
            return;
        }

        if (!$this->isSulfuras($item)) {
            $this->decreaseQuality($item);
        }
    }

    private function updateItemBeforeSellInChange(Item $item): void
    {
        if($this->isBackstagePass($item)){
            $this->updateBackstagePass($item);
            return;
        }
        
        if($this->isAgedBrie($item)){
            $this->increaseQuality($item);
            return;
        }

        if($this->isConjured($item)){
            $this->updateConjured($item);
            return;
        }

        if (!$this->isSulfuras($item)) {
            $this->decreaseQuality($item);
        }
    }
}
