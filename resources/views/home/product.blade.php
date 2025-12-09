<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col md:flex-row gap-8">
                    <!-- Product Image -->
                    <div class="w-full md:w-1/2">
                        <div class="aspect-square bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">
                            @if($product->productImages->count() > 0)
                                <img src="{{ asset('storage/' . $product->productImages->first()->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400 text-2xl">Product Image</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="w-full md:w-1/2">
                        <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                        <p class="text-2xl text-primary font-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        
                        <div class="flex items-center gap-4 mb-6">
                            <div class="text-sm text-gray-500">
                                Category: <span class="font-medium text-gray-700">{{ $product->productCategory->name }}</span>
                            </div>
                            <div class="text-sm text-gray-500">
                                Condition: <span class="font-medium text-gray-700 capitalize">{{ $product->condition }}</span>
                            </div>
                            <div class="text-sm text-gray-500">
                                Weight: <span class="font-medium text-gray-700">{{ $product->weight }}g</span>
                            </div>
                        </div>

                        <div class="border-t border-b py-4 mb-6">
                            <h3 class="font-semibold mb-2">Description</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                        </div>
                        
                        <div class="flex items-center gap-4 mb-8">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600">Store:</span>
                                <span class="font-semibold">{{ $product->store->name }}</span>
                                @if($product->store->is_verified)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Verified</span>
                                @endif
                                <span class="text-xs text-gray-400">({{ $product->store->city }})</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-4">
                            <a href="{{ route('checkout', $product->slug) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold w-full transition text-center">
                                Buy Now
                            </a>
                            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-lg font-semibold transition whitespace-nowrap">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
