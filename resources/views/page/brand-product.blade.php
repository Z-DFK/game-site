<x-show>
    <x-container>
    <div class=" justify-center items-center gap-2 flex flex-col md:flex md:flex-col md:items-center md:gap-2 pb-9 ">
        <x-slot:title>{{ $titlePage }}</x-slot:title>
        <h1 class="text-[24px] font-bold" >Страница категории</h1>
        <livewire:product-list :products="$products" />
        <a href="{{route('product.index')}}" class="link   text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Все продукты</a>
    </div>
</x-container>
</x-show>
