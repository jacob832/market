<?php

namespace App\Listeners;
use App\Events\ProductViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductViewer $event)
    {
        $this->updateViews($event->product);
    }
    function updateViews($product)
    {
        $product->views = $product->views + 1;
        $product->save();
    }
}
