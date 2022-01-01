<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use App\Models\Product;

class discount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discount:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'discount price of products';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $products = Product::get();
        $date = date('m/d/Y h:i:s a', time());
        $fDate = new DateTime($date); 
        foreach($products as $product)
        {
            $lDate = new DateTime($product->expireDate);
            $interval = $fDate->diff($lDate);
            $days = $interval->format('%a');
            if($days >= $product->minNoDaysFirstOffer)
            {
                $product -> update(['priceAfterDiscount' => ($product->price)-($product->price * $product->firstOfferPrice)]);
            }
            else if($days >= $product->minNoDaysSecondOffer && $days < $product->minNoDaysFirstOffer)
            {
                $product -> update(['priceAfterDiscount' => ($product->price)-($product->price * $product->secondOfferPrice)]);
            }
            else if(($days < $product->minNoDaysSecondOffer) && (($days <= $product->minNoDaysThirdOffer) || ($days >$product->minNoDaysThirdOffer)))
                $product -> update(['priceAfterDiscount' => ($product->price)-($product->price * $product->thirdOfferPrice)]);
        }    
    }
}
