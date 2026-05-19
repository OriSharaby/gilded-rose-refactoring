<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
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
            if (!$this->isAgedBrie($item) and !$this->isBackstagePass($item)) {
                if (!$this->isSulfuras($item)) {
                        $this->decreaseQuality($item);
                }
            } else {
                $this->increaseQuality($item);
                if ($this->isBackstagePass($item)) {
                    if ($item->sellIn < 11) {
                        $this->increaseQuality($item);
                    }
                    if ($item->sellIn < 6) {
                        $this->increaseQuality($item);
                    }
                }
            }

            $this->decreaseSellIn($item);

            if ($item->sellIn < 0) {
                if (!$this->isAgedBrie($item)) {
                    if (!$this->isBackstagePass($item)) {
                        if (!$this->isSulfuras($item)) {
                            $this->decreaseQuality($item);
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    $this->increaseQuality($item);
                }
            }
        }
    }

    private function decreaseQuality(Item $item): void{
        if($item->quality > 0 ){
            $item->quality--;
        }
    }

    private function increaseQuality(Item $item): void{
        if($item->quality < 50 ){
            $item->quality++;
        }
    }

    private function decreaseSellIn(Item $item): void{
        if(!$this->isSulfuras($item)){
            $item->sellIn--;
        }
    }

    private function isAgedBrie(Item $item): bool{
        return $item->name === 'Aged Brie';
    }

    private function isBackstagePass(Item $item): bool{
        return $item->name === 'Backstage passes to a TAFKAL80ETC concert';
    }

    private function isSulfuras(Item $item): bool{
        return $item->name === 'Sulfuras, Hand of Ragnaros';
    }
}
