<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- component -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/countup@1.8.2/dist/countUp.min.js"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css">

<!-- Date Range Picker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<section class="container mx-auto mt-20 ">



    <div class="mb-5">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

            <div class="sm:col-span-2 sm:col-start-1">
                <div class="mt-2">
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>
            <!-- <div class="sm:col-span-2 sm:col-start-1">
                <label class="block text-sm font-medium leading-6 text-gray-900">Desde</label>
                <div class="mt-2">
                    <input type="date" name="desde" id="desde" value="<?php echo date('Y-m-d'); ?>"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Hasta</label>
                <div class="mt-2">
                    <input type="time" name="hasta" id="hasta" value="<?php echo date('Y-m-d'); ?>"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div> -->
            <div class="sm:col-span-2">
                <button type="submit" onclick="btn()" class="mt-2 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 
                focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Consultar</button>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-5 gap-4">

        <div class="col-span-3">

            <div class="w-full bg-white flex items-center justify-center px-5 py-5">
                <div class="bg-gray-100 text-black-500 rounded shadow-xl py-5 px-5 w-full">
                    <div class="flex w-full">
                        <h3 class="text-lg font-semibold leading-tight flex-1">TOTAL LEADS MATRICULADOS CARRERAS</h3>
                        <div class="relative h-5 leading-none">
                            <button class="text-xl text-gray-900 hover:text-gray-500 h-6 focus:outline-none">
                                <i class="mdi"></i>
                            </button>
                        </div>
                    </div>
                    <div class="relative overflow-hidden transition-all duration-500">
                        <div>
                            <div class="pb-4 lg:pb-6">
                                <h4 class="text-2xl lg:text-3xl text-black font-semibold leading-tight inline-block"
                                    id="countMatriculados">0
                                </h4>
                            </div>
                            <div class="pb-4 lg:pb-6">
                                <span class="text-green-600 font-semibold"><span id="porcentajeMatriculado"></span>%</span>
                                <div
                                    class="overflow-hidden rounded-full h-3 bg-slate-200 flex transition-all duration-500 w-full">
                                    <div class="h-full bg-green-600" id="barraMatriculado" style="width:0%"></div>
                                </div>
                            </div>
                            <div class="flex -mx-4">
                                <div class="w-1/3 px-4 border-l border-gray-700">
                                    <div class="text-sm">
                                        <span
                                            class="inline-block w-2 h-2 rounded-full mr-1 align-middle bg-blue-500">&nbsp;</span>
                                        <span class="align-middle text-blue-500 font-medium">&nbsp; Meta</span>
                                    </div>
                                    <div class="font-medium text-lg text-black">
                                        <span id="metaLeads">0</span>
                                    </div>
                                </div>
                                <div class="w-1/3 px-4 border-l border-gray-700">
                                    <div class="text-sm">
                                        <span
                                            class="inline-block w-2 h-2 rounded-full mr-1 align-middle bg-red-400">&nbsp;</span>
                                        <span class="align-middle text-red-500 font-medium">&nbsp; No Contactados</span>
                                    </div>
                                    <div class="font-medium text-lg text-black">
                                        <span id="countNoContactados">0</span>
                                    </div>
                                </div>
                                <div class="w-1/3 px-4 border-l border-gray-700">
                                    <div class="text-sm">
                                        <span
                                            class="inline-block w-2 h-2 rounded-full mr-1 align-middle bg-red-300">&nbsp;</span>
                                        <span class="align-middle text-red-500 font-medium">&nbsp; Perdidos</span>
                                    </div>
                                    <div class="font-medium text-lg text-black">
                                        <span id="countPerdidos">0</span>
                                    </div>
                                </div>
                                <div class="w-1/3 px-4 border-l border-gray-700">
                                    <div class="text-sm">
                                        <span
                                            class="inline-block w-2 h-2 rounded-full mr-1 align-middle bg-sky-300">&nbsp;</span>
                                        <span class="align-middle text-sky-500 font-medium">&nbsp; Leads Nuevos</span>
                                    </div>
                                    <div class="font-medium text-lg text-black">
                                        <span id="countLeadsEntrantes">3</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full bg-white flex items-center justify-center px-5 py-5 mt-10">
                <div class="bg-gray-100 text-black-500 rounded shadow-xl py-5 px-5 w-full">
                    <div class="flex w-full">
                        <h3 class="text-lg font-semibold leading-tight flex-1">TOTAL LEADS MATRICULADOS CURSOS</h3>
                        <div class="relative h-5 leading-none">
                            <button class="text-xl text-gray-900 hover:text-gray-500 h-6 focus:outline-none">
                                <i class="mdi"></i>
                            </button>
                        </div>
                    </div>
                    <div class="relative overflow-hidden transition-all duration-500">
                        <div>
                            <div class="pb-4 lg:pb-6">
                                <h4 class="text-2xl lg:text-3xl text-black font-semibold leading-tight inline-block"
                                    id="countMatriculadosCursos">0
                                </h4>
                            </div>
                            <div class="pb-4 lg:pb-6">
                                <span class="text-green-600 font-semibold"><span id="porcentajeMatriculadoCursos"></span>%</span>
                                <div
                                    class="overflow-hidden rounded-full h-3 bg-slate-200 flex transition-all duration-500 w-full">
                                    <div class="h-full bg-green-600" id="barraMatriculadoCursos" style="width:0%"></div>
                                </div>
                            </div>
                            <div class="flex -mx-4">
                                <div class="w-1/3 px-4 border-l border-gray-700">
                                    <div class="text-sm">
                                        <span
                                            class="inline-block w-2 h-2 rounded-full mr-1 align-middle bg-blue-500">&nbsp;</span>
                                        <span class="align-middle text-blue-500 font-medium">&nbsp; Meta</span>
                                    </div>
                                    <div class="font-medium text-lg text-black">
                                        <span id="metaLeadsCursos">0</span>
                                    </div>
                                </div>
                                <div class="w-1/3 px-4 border-l border-gray-700">
                                    <div class="text-sm">
                                        <span
                                            class="inline-block w-2 h-2 rounded-full mr-1 align-middle bg-red-400">&nbsp;</span>
                                        <span class="align-middle text-red-500 font-medium">&nbsp; No Contactados</span>
                                    </div>
                                    <div class="font-medium text-lg text-black">
                                        <span id="countNoContactadosCursos">0</span>
                                    </div>
                                </div>
                                <div class="w-1/3 px-4 border-l border-gray-700">
                                    <div class="text-sm">
                                        <span
                                            class="inline-block w-2 h-2 rounded-full mr-1 align-middle bg-red-300">&nbsp;</span>
                                        <span class="align-middle text-red-500 font-medium">&nbsp; Perdidos</span>
                                    </div>
                                    <div class="font-medium text-lg text-black">
                                        <span id="countPerdidosCursos">0</span>
                                    </div>
                                </div>
                                <div class="w-1/3 px-4 border-l border-gray-700">
                                    <div class="text-sm">
                                        <span
                                            class="inline-block w-2 h-2 rounded-full mr-1 align-middle bg-sky-300">&nbsp;</span>
                                        <span class="align-middle text-sky-500 font-medium">&nbsp; Leads Nuevos</span>
                                    </div>
                                    <div class="font-medium text-lg text-black">
                                        <span id="countLeadsEntrantesCursos">3</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-span-2">
            <div class="px-4 mb-20">
                <div class="flex-auto overflow-y-scroll rounded-3xl bg-white text-sm leading-6 shadow-lg ring-1 ring-gray-900/5"
                    style="height:700px;">
                    <div class="p-4" id="content_asesores">

                        <!-- <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                            <div
                                class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                                </svg>
                            </div>
                            <div class="w-full">
                                <a href="#" class="font-semibold text-gray-900">Analytics
                                    <span class="absolute inset-0"></span>
                                </a>
                                <div class="flex w-full justify-between">
                                    <p class="mt-1 text-gray-600">Get a better understanding of yo</p>
                                    <p class="text-gray-400">gaaaa</p>
                                </div>
                                
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>

    </div>

</section>


<script src="<?=$baseUrl?>js/index.js"></script>
<script src="<?=$baseUrl?>js/inicio/index.js"></script>