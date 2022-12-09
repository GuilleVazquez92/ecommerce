<x-app-layout>
    <div class="container py-8">

        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class=" text-lg uppercase font-semibold text-gray-700 col-span-4">
                        {{$category->name}}
                    </h1>

                    <a href="{{route('categories.show', $category)}}"
                       class="text-sm text-gray-500 ml-2 font-semibold hover:text-gray-800
                        hover:underline">
                        Ver más
                    </a>
                    <p></p>
                </div> 
                @livewire('category-products', ['category' => $category])
                {{-- 'category' variable que está siendo enviada app\livewire --}}
            </section>
        @endforeach
    </div>

@if(!empty($payments))
    <div>
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl dark:text-white" align="center">

            Lista de Pedidos
        </h1>
        
<div class="overflow-x-auto relative">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
           
            <tr>
                <th scope="col" class="py-3 px-6">
                    Orden
                </th>
                <th scope="col" class="py-3 px-6">
                    Contacto
                </th>
                <th scope="col" class="py-3 px-6">
                    Contacto Numero
                </th>
                <th scope="col" class="py-3 px-6">
                    Precio
                </th>
                <th scope="col" class="py-3 px-6">
                    Estado
                </th>
            
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$payment->order_id}}
                </th>
                <td class="py-4 px-6">
                    {{$payment->order->contact}}
                </td>
                 <td class="py-4 px-6">
                    {{$payment->order->phone}}
                </td>
                 <td class="py-4 px-6">
                    {{$payment->order->total}}
                </td>
                <td class="py-4 px-6">
                    {{$payment->status}}
                </td>
                
            </tr>
            @endforeach 
        </tbody>
    </table>
</div>

    </div>
    @endif
    {{-- Solución de desface --}}
    @push('slider')
        <script>
            // Este trozo se ejecutará luego de ejecutar la acción dentro de la función loadPosts de CategoryProducts en la carpeta Livewire
            Livewire.on('glider', function(id){
                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots:'.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });
            });
            
        </script>
    @endpush
</x-app-layout>