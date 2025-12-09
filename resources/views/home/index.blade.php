<x-public-layout>
    <!-- Hero Section -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Welcome to E-Shop
            </h1>
            <p class="mt-2 text-gray-600">Find the best products at the best prices.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Categories -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold mb-4">Categories</h2>
            <div class="flex space-x-4 overflow-x-auto pb-4">
                <a href="{{ route('home') }}" class="{{ !request('category') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }} px-4 py-2 rounded-full text-sm font-medium transition">All</a>
                @foreach($categories as $category)
                    <a href="{{ route('home', ['category' => $category->slug]) }}" 
                       class="{{ request('category') == $category->slug ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800 border hover:bg-gray-50' }} px-4 py-2 rounded-full text-sm font-medium transition shadow-sm whitespace-nowrap">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Products Grid -->
        <div>
            <h2 class="text-2xl font-bold mb-4">Latest Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                        <a href="{{ route('product.detail', $product->slug) }}">
                            <!-- Placeholder Image -->
                            <div class="h-48 bg-gray-200 w-full flex items-center justify-center overflow-hidden">
                                @if($product->productImages->count() > 0)
                                    <img src="{{ asset('storage/' . $product->productImages->first()->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">{{ $product->productCategory->name }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-primary font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-400">{{ $product->store->city }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-public-layout>
