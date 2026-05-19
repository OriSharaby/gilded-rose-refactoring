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
            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $this->decreaseQuality($item);
                }
            } else {
                $this->increaseQuality($item);
                if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->sellIn < 11) {
                        $this->increaseQuality($item);
                    }
                    if ($item->sellIn < 6) {
                        $this->increaseQuality($item);
                    }
                }
            }

            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
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
}
