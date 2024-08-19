<div id="preview"  class="flex flex-row bg-slate-600 p-3 rounded-lg text-white sm:w-3/4 md:w-4/5 mx-8 my-6">
    <section class="flex flex-row w-full pt-6">
        <div id="preview-carousel" class="w-3/5 relative mr-2" data-carousel="static">

            <div class="bg-slate-900 flex justify-center py-auto items-center w-full h-full -z-10 hidden" id="carrousel-placeholder">
                <span>Vista previa de la publicación</span>
            </div>
            
            <div class="relative h-full overflow-hidden rounded-lg py-auto" id="rootCarrousel">
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active" data-carousel-number="0">
                    <img src="{{asset('publications-pictures/vistaprevia.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item="" data-carousel-number="1">
                    <img src="" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse" id="carrousel-slider">
                
            </div>

            <div class="hidden" id="buttonSlideCarousel">
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev="">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"></path>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
    
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next="">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"></path>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
            <!-- <div class="w-full flex flex-row justify-between my-auto z-40">
            </div> -->
        </div>

        <div class="flex flex-col sm:w-3/4 md:w-2/5 bg-slate-500">
            <section class=" w-full bg-slate-500 overflow-y-auto p-2 show-scroll fixed-filters-zone my-h-screen my-max-h-screen">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum dolorum facilis impedit veniam reiciendis a tempore optio aperiam asperiores quos in maxime, inventore, deserunt, debitis eius repellat quidem libero accusamus.
                Neque suscipit ratione aspernatur velit eveniet, fuga, tenetur itaque deleniti eos modi eius culpa iusto iure hic dolor optio reprehenderit sunt illum provident assumenda. Nesciunt beatae natus necessitatibus tempore ab!
                Maxime in, quis vel quae tempore, quas, modi eius reprehenderit alias eum consectetur nihil corrupti officiis! Laborum excepturi eaque, dolorum nostrum molestias officia earum non ducimus fugiat veritatis reprehenderit dolore?
                Quasi iste voluptatum corporis animi eaque, asperiores rerum, iure ullam eius ratione, unde quidem incidunt eligendi sed quis. Perferendis nisi minima illum laudantium vitae eveniet vel reiciendis necessitatibus aliquam numquam.
                Animi veritatis voluptatibus vel hic quis officiis voluptas? Eaque quisquam aut necessitatibus suscipit nulla excepturi. Adipisci ullam dicta molestiae magnam aliquid sed, maiores consectetur. Architecto dignissimos quia minima delectus aliquam?
                Velit unde, ratione, odio, architecto facilis tempora facere at hic voluptatem quaerat quia earum omnis minima vitae suscipit provident molestiae. Officia quis consequuntur quos dicta eaque maxime expedita rerum unde.
                Aperiam illum amet molestias nemo quae? Quod unde fugit temporibus nihil quia, ipsum iusto suscipit. Enim repudiandae earum nobis velit molestias illum, neque perferendis, nisi fuga nihil porro dolorem cumque.
                Quisquam doloribus perspiciatis itaque aspernatur labore odit, voluptatum sint enim voluptas suscipit fuga? Maiores mollitia velit ab. Inventore iusto ab, optio officiis quaerat fugit beatae adipisci quibusdam, odit voluptates architecto.
                Eius accusantium iure reprehenderit, hic illum soluta. Quia veniam, deleniti qui laboriosam dolores nihil aut voluptatibus perspiciatis ad delectus, culpa placeat quo repellendus rerum atque fuga soluta dicta, accusamus maiores!
                Nisi quo illum eligendi distinctio odio? Aliquam molestiae consequuntur quasi quibusdam quis ducimus accusantium impedit dignissimos expedita debitis ex quisquam dolor quam maxime nulla iste, ut itaque reiciendis nesciunt? Odio?
                Deserunt dolore dolorem aspernatur sapiente eius optio voluptatum modi molestias ut voluptatibus velit numquam eligendi aperiam, iure incidunt deleniti quam? Rem nemo delectus a illo exercitationem consectetur debitis? Voluptatem, cum.
                Et unde soluta culpa quasi veniam repellat consectetur commodi labore. Optio nisi eligendi magnam commodi, consequatur impedit hic neque ullam assumenda odit nemo beatae praesentium officiis ipsam ratione fuga officia.
                Optio quaerat enim aliquid neque aperiam asperiores rerum debitis eos porro ipsum non vitae minus iusto animi impedit sed repudiandae vero molestiae dolorum, cum quos. Deleniti tempora ducimus quae eius.
                Rerum voluptas optio deleniti. Totam, ea saepe. In laudantium temporibus quibusdam sapiente aliquam quod nihil repudiandae quos assumenda alias incidunt, illum sit ut ducimus distinctio. Sit aliquam fugit vel. Fugit!
                Modi laborum atque officiis nemo molestiae cupiditate vel sit unde, similique amet, laudantium asperiores repellat at quia reiciendis! Explicabo at nihil voluptates quo placeat modi ducimus autem eveniet eligendi recusandae!
                Est doloremque voluptatem ducimus, aperiam, sit odit quis distinctio neque voluptas deserunt cum veniam facere beatae sed expedita assumenda veritatis culpa nobis, quae natus non! Illum beatae libero iusto fugit.
                Blanditiis asperiores modi necessitatibus! Exercitationem tempore unde, incidunt explicabo sequi iure corrupti deleniti soluta fugiat animi deserunt veniam eos alias, fugit, debitis consequuntur quidem aliquid. Possimus dicta atque ea aliquam.
                Vel reprehenderit odio consectetur at consequuntur sequi deleniti molestias repellat dolorum perferendis in explicabo illo dolores ex alias voluptatum ducimus enim sit non, natus omnis quibusdam asperiores. Tempore, at sapiente!
                Architecto dignissimos nemo alias facere corporis neque laudantium atque sapiente, ducimus, voluptatibus officiis eos ratione sequi, earum reprehenderit voluptatum obcaecati repellat molestias. Cumque, iure ratione illo cupiditate quasi officiis facilis!
                Beatae omnis vel nisi, molestiae distinctio asperiores. Similique consectetur, suscipit voluptatibus porro unde minus perspiciatis quasi cumque odio, assumenda molestias repellat pariatur, eligendi voluptates amet dicta iure. Voluptate, aperiam vitae.</p>
            </section>
            <div class="bottom-0 relative">
                <button class="w-full bg-slate-700 rounded p-2">Enviar Mensaje</button>
            </div>
        </div>
    </section>
</div>