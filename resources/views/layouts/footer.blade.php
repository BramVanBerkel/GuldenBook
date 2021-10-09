<!-- This example requires Tailwind CSS v2.0+ -->
<footer class="bg-white">
    <div class="max-w-7xl mx-auto py-7 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <div class="mt-8 md:mt-0 md:order-1">
            <p class="text-center text-base text-gray-400">
                &copy; {{ now()->format('Y') }} GuldenBook. All rights reserved.
                <br>
                Please note that GuldenBook is an initiative by the volunteers of the Gulden community.
                The data may be inaccurate. If you spot any discrepancies, please email to: <x-link href="mailto:contact@guldenbook.com">contact@guldenbook.com</x-link>
            </p>
        </div>
    </div>
</footer>
