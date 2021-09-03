<?php

namespace App\Jobs;

use App\Models\Address\Address;
use App\Models\WitnessAddressPart;
use App\Repositories\AddressRepository;
use App\Repositories\WitnessAddressRepository;
use App\Services\GuldenService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UpdateWitnessInfo implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(GuldenService            $guldenService,
                           WitnessAddressRepository $witnessAddressRepository,
                           AddressRepository        $addressRepository)
    {
        $witnessInfo = $guldenService->getWitnessInfo(verbose: true);

        $witnessInfo->get('witness_address_list')->groupBy('address')
            ->each(function (Collection $parts, string $address) use ($witnessAddressRepository, $addressRepository) {
                $address = $addressRepository->findAddress($address);

                if(!$address instanceof Address) {
                    return;
                }

                $witnessAddressRepository->syncParts($address, $parts);
            });
    }
}
