
<section  aria-labelledby="intro-title" aria-describedby="intro-description"
class="w-full  h-full pt-[100px] md:pt-[250px] bg-no-repeat bg-cover  bg-center bg-gray-300"
style="background-image:  url({{ asset('storage/11.jfif') }})">
<x-container>
    <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-3 pb-12 md:pb-[250px]">
        {{-- начало колонки слева --}}
        <div class="grid col-span-1 gap-y-6 md:col-span-2">
            <h1 class="font-bold text-white text-[24px] leading-[64px] md:text-[80px] md:leading-[88px]"
                id="intro-title">Добро пожаловать в Белый сайт игр</h1>
            <div class="text-2xl font-normal text-white">
                <p id="intro-description">В этом сайте присутствуют все виды игр</p>
            </div>
            <ul class="flex gap-4">
                <li class="inline-flex">
                    <a aria-label="Get Started" href="" class="bg-gray-500 flex items-center gap-3 text-center text-white rounded-full px-[30px] py-[12px] border border-gray-600 font-semibold">
                        Контакты
                        <span class="w-[20px] h-[20px] rounded-full bg-white flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" class="text-green-700 size-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                            </svg>
                        </span>
                    </a>
                </li>
            <ul>
        </div>
        {{-- конец колонки слева --}}
        {{-- начало колонки справа --}}

        {{-- конец колонки справа --}}
    </div>
</x-container>


</section>


