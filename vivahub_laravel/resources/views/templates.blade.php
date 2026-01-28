@extends('layouts.frontend')

@section('content')
<main class="relative pt-24 min-h-screen">
    <div class="mx-auto w-full max-w-[1440px] px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-maroon/10 pb-6 dark:border-gold/10">
            <div class="flex flex-col gap-2">
                <h2 class="text-3xl md:text-4xl font-display font-bold leading-tight tracking-tight text-maroon dark:text-gold text-shadow-gold">Exquisite Wedding Templates</h2>
                <p class="text-maroon/60 dark:text-champagne/70 text-lg font-sans">Discover your perfect invitation from our premium collection.</p>
            </div>
            <button class="lg:hidden flex items-center gap-2 rounded-lg border border-maroon/20 px-4 py-2 text-sm font-bold text-maroon hover:bg-maroon/5 dark:text-gold dark:border-gold/20">
                <span class="material-symbols-outlined text-lg">tune</span>
                Filters
            </button>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <aside class="hidden lg:flex w-64 shrink-0 flex-col gap-6">
                <div class="flex items-center justify-between">
                    <h3 class="font-bold text-lg text-maroon dark:text-gold">Filters</h3>
                    <button class="text-xs font-medium text-maroon/60 hover:text-maroon uppercase tracking-wider dark:text-champagne/60 dark:hover:text-gold">Reset</button>
                </div>
                <div class="flex flex-col gap-4">
                    <!-- Color Theme Filter -->
                    <details class="group" open="">
                        <summary class="flex cursor-pointer items-center justify-between py-2 list-none">
                            <span class="text-sm font-bold text-maroon dark:text-white">Color Theme</span>
                            <span class="material-symbols-outlined text-maroon/60 transition-transform group-open:rotate-180 dark:text-champagne/60">expand_more</span>
                        </summary>
                        <div class="pt-2 pb-4">
                            <div class="flex flex-wrap gap-3">
                                <label class="cursor-pointer group/color relative size-8 rounded-full border border-maroon/20 dark:border-white/20 shadow-sm" style="background-color: #ef4444;"> 
                                    <input class="peer sr-only" name="color" type="radio"/>
                                    <span class="absolute inset-0 hidden peer-checked:flex items-center justify-center text-white">
                                        <span class="material-symbols-outlined text-[16px]">check</span>
                                    </span>
                                </label>
                                <label class="cursor-pointer group/color relative size-8 rounded-full border border-maroon/20 dark:border-white/20 shadow-sm" style="background-color: #D4AF37;"> 
                                    <input checked="" class="peer sr-only" name="color" type="radio"/>
                                    <span class="absolute inset-0 hidden peer-checked:flex items-center justify-center text-black">
                                        <span class="material-symbols-outlined text-[16px]">check</span>
                                    </span>
                                </label>
                                <!-- Other Colors -->
                                <label class="cursor-pointer group/color relative size-8 rounded-full border border-maroon/20 dark:border-white/20 shadow-sm" style="background-color: #fce7f3;"> 
                                    <input class="peer sr-only" name="color" type="radio"/>
                                    <span class="absolute inset-0 hidden peer-checked:flex items-center justify-center text-black">
                                        <span class="material-symbols-outlined text-[16px]">check</span>
                                    </span>
                                </label>
                                <label class="cursor-pointer group/color relative size-8 rounded-full border border-maroon/20 dark:border-white/20 shadow-sm" style="background-color: #15803d;"> 
                                    <input class="peer sr-only" name="color" type="radio"/>
                                    <span class="absolute inset-0 hidden peer-checked:flex items-center justify-center text-white">
                                        <span class="material-symbols-outlined text-[16px]">check</span>
                                    </span>
                                </label>
                                <label class="cursor-pointer group/color relative size-8 rounded-full border border-maroon/20 dark:border-white/20 shadow-sm" style="background-color: #1e3a8a;"> 
                                    <input class="peer sr-only" name="color" type="radio"/>
                                    <span class="absolute inset-0 hidden peer-checked:flex items-center justify-center text-white">
                                        <span class="material-symbols-outlined text-[16px]">check</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </details>
                    <div class="h-px w-full bg-maroon/10 dark:bg-gold/10"></div>
                    
                    <!-- Format Filter -->
                    <details class="group" open="">
                        <summary class="flex cursor-pointer items-center justify-between py-2 list-none">
                            <span class="text-sm font-bold text-maroon dark:text-white">Format</span>
                            <span class="material-symbols-outlined text-maroon/60 transition-transform group-open:rotate-180 dark:text-champagne/60">expand_more</span>
                        </summary>
                        <div class="pt-2 pb-4 flex flex-col gap-2">
                            <label class="flex items-center gap-3 cursor-pointer group/item">
                                <div class="relative flex items-center">
                                    <input class="peer size-4 appearance-none rounded border border-maroon/40 checked:bg-maroon checked:border-maroon focus:ring-1 focus:ring-maroon/50 transition-all dark:border-gold/40 dark:checked:bg-gold dark:checked:border-gold" type="checkbox"/>
                                    <span class="material-symbols-outlined absolute left-0 top-0 text-white dark:text-obsidian text-sm pointer-events-none opacity-0 peer-checked:opacity-100">check</span>
                                </div>
                                <span class="text-sm text-maroon/70 group-hover:text-maroon transition-colors dark:text-champagne/70 dark:group-hover:text-white">Video Invite</span>
                            </label>
                            <!-- Repeat for others... -->
                             <label class="flex items-center gap-3 cursor-pointer group/item">
                                <div class="relative flex items-center">
                                    <input checked="" class="peer size-4 appearance-none rounded border border-maroon/40 checked:bg-maroon checked:border-maroon focus:ring-1 focus:ring-maroon/50 transition-all dark:border-gold/40 dark:checked:bg-gold dark:checked:border-gold" type="checkbox"/>
                                    <span class="material-symbols-outlined absolute left-0 top-0 text-white dark:text-obsidian text-sm pointer-events-none opacity-0 peer-checked:opacity-100">check</span>
                                </div>
                                <span class="text-sm text-maroon/70 group-hover:text-maroon transition-colors dark:text-champagne/70 dark:group-hover:text-white">E-Card (Image)</span>
                            </label>
                             <label class="flex items-center gap-3 cursor-pointer group/item">
                                <div class="relative flex items-center">
                                    <input class="peer size-4 appearance-none rounded border border-maroon/40 checked:bg-maroon checked:border-maroon focus:ring-1 focus:ring-maroon/50 transition-all dark:border-gold/40 dark:checked:bg-gold dark:checked:border-gold" type="checkbox"/>
                                    <span class="material-symbols-outlined absolute left-0 top-0 text-white dark:text-obsidian text-sm pointer-events-none opacity-0 peer-checked:opacity-100">check</span>
                                </div>
                                <span class="text-sm text-maroon/70 group-hover:text-maroon transition-colors dark:text-champagne/70 dark:group-hover:text-white">Multi-page PDF</span>
                            </label>
                        </div>
                    </details>
                    <div class="h-px w-full bg-maroon/10 dark:bg-gold/10"></div>

                     <!-- Price Range -->
                    <details class="group">
                        <summary class="flex cursor-pointer items-center justify-between py-2 list-none">
                            <span class="text-sm font-bold text-maroon dark:text-white">Price Range</span>
                            <span class="material-symbols-outlined text-maroon/60 transition-transform group-open:rotate-180 dark:text-champagne/60">expand_more</span>
                        </summary>
                        <div class="pt-2 pb-4">
                            <input class="w-full accent-maroon dark:accent-gold h-1 bg-maroon/20 dark:bg-gold/20 rounded-lg appearance-none cursor-pointer" type="range"/>
                            <div class="flex justify-between mt-2 text-xs text-maroon/60 dark:text-champagne/60">
                                <span>$0</span>
                                <span>$500+</span>
                            </div>
                        </div>
                    </details>
                </div>
                
                <!-- CTA Box -->
                <div class="mt-8 rounded-xl bg-gradient-to-br from-maroon/10 to-maroon/5 p-5 border border-maroon/20 dark:from-gold/10 dark:to-gold/5 dark:border-gold/20">
                    <div class="mb-3 text-maroon dark:text-gold">
                        <span class="material-symbols-outlined text-3xl">workspace_premium</span>
                    </div>
                    <h4 class="font-bold text-maroon dark:text-white mb-1 font-display">Custom Design</h4>
                    <p class="text-xs text-maroon/70 dark:text-champagne/70 mb-3 leading-relaxed font-sans">Need something truly unique? Work with our designers.</p>
                    <a class="text-xs font-bold text-maroon dark:text-gold hover:underline" href="{{ url('contact') }}">Learn more →</a>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col gap-6">
                <!-- Filter Chips -->
                <div class="hide-scrollbar flex gap-3 overflow-x-auto pb-2">
                    <button class="shrink-0 rounded-full bg-maroon px-6 py-2 text-sm font-medium text-white shadow-md hover:bg-maroon-dark transition-colors dark:bg-gold dark:text-obsidian">
                        All
                    </button>
                    <button class="shrink-0 rounded-full bg-transparent border border-maroon/20 px-6 py-2 text-sm font-medium text-maroon hover:bg-maroon/5 transition-colors dark:border-gold/30 dark:text-champagne dark:hover:bg-gold/10">
                        Traditional
                    </button>
                    <button class="shrink-0 rounded-full bg-transparent border border-maroon/20 px-6 py-2 text-sm font-medium text-maroon hover:bg-maroon/5 transition-colors dark:border-gold/30 dark:text-champagne dark:hover:bg-gold/10">
                        Modern
                    </button>
                    <button class="shrink-0 rounded-full bg-transparent border border-maroon/20 px-6 py-2 text-sm font-medium text-maroon hover:bg-maroon/5 transition-colors dark:border-gold/30 dark:text-champagne dark:hover:bg-gold/10">
                        Regal
                    </button>
                    <button class="shrink-0 rounded-full bg-transparent border border-maroon/20 px-6 py-2 text-sm font-medium text-maroon hover:bg-maroon/5 transition-colors dark:border-gold/30 dark:text-champagne dark:hover:bg-gold/10">
                        Minimal
                    </button>
                </div>

                <!-- Template Grid -->
                <!-- Use glass-card-light style or just rounded-2xl with shadow -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-max">
                    <!-- Card 1 -->
                    <div class="group flex flex-col gap-3">
                        <div class="relative aspect-[9/16] w-full overflow-hidden rounded-[1.5rem] border-[6px] border-maroon/5 bg-gray-100 shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 dark:border-gold/10 dark:bg-gray-800">
                            <img alt="The Maharaja's Scroll" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3yU6obH772n0HrlXy8f8DfubTQpsi03-LVdjD4DUKiHhMvOjuzDeqAnB2tXqE6q5tA_vzpvoNdmziv7sArrLbQd__j4pi3E9ZMN8VsLCTbuI7aQP-HVQW7WLFRze0kMR-5TxTUhwjLPh7Zz06tzbohyWN5v-7gO9Ovuudx147TdNcrv9EIXiVRXj_EyyAxJeHcdysVzUE6EUCmKT-xvb6gAyVriUwsOcNUztLhkcxvxMN0QC9w6Yshu4X6MoSwX0jK1CrPVa8Ztb0">
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-maroon/80 dark:bg-obsidian/80 opacity-0 transition-opacity duration-300 group-hover:opacity-100 backdrop-blur-[2px]">
                                <button class="rounded-full bg-white px-8 py-3 text-sm font-bold text-maroon shadow-lg hover:bg-gold hover:text-obsidian transition-colors transform hover:scale-105">
                                    Preview
                                </button>
                            </div>
                            <div class="absolute top-4 right-4 rounded-full bg-obsidian/60 px-3 py-1 text-[10px] font-bold text-white backdrop-blur-sm border border-white/10">
                                VIDEO
                            </div>
                        </div>
                        <div class="flex justify-between items-start px-1">
                            <div>
                                <h3 class="font-bold font-display text-maroon dark:text-white leading-tight">The Maharaja's Scroll</h3>
                                <p class="text-xs font-medium font-sans text-maroon/60 dark:text-champagne/60 mt-1">Traditional</p>
                            </div>
                            <button class="text-maroon/40 hover:text-maroon transition-colors material-symbols-outlined dark:text-champagne/40 dark:hover:text-gold">favorite</button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="group flex flex-col gap-3">
                        <div class="relative aspect-[9/16] w-full overflow-hidden rounded-[1.5rem] border-[6px] border-maroon/5 bg-gray-100 shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 dark:border-gold/10 dark:bg-gray-800">
                            <img alt="Lotus Bloom" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7FvM5AY9983-UU4SIrrL10HXdOAHBeZENGR_szHAzKwpOi9XPIjda0I4SqAeSs5-RtbmEtav6-SMWVTiY15jXBOmQIN-fKOcbBoP9gOLVNjA6Hn8ePzwyQ0WTY1v0tMWhP2b_ZC-172gdAS9dJBaZq1iO67T4-0eDSdw88zDUMjxt4OQYRlUYTGr6U7M2IVZr6ZtSJcpxZKfSCzeLDSqx2cOBuke7AtH4jamb7BNv19u5CZGomowWun1bbAo_LKOv_TFNc5jizKAl">
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-maroon/80 dark:bg-obsidian/80 opacity-0 transition-opacity duration-300 group-hover:opacity-100 backdrop-blur-[2px]">
                                <button class="rounded-full bg-white px-8 py-3 text-sm font-bold text-maroon shadow-lg hover:bg-gold hover:text-obsidian transition-colors transform hover:scale-105">
                                    Preview
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-start px-1">
                            <div>
                                <h3 class="font-bold font-display text-maroon dark:text-white leading-tight">Lotus Bloom</h3>
                                <p class="text-xs font-medium font-sans text-maroon/60 dark:text-champagne/60 mt-1">Minimal • Pastel</p>
                            </div>
                            <button class="text-maroon/40 hover:text-maroon transition-colors material-symbols-outlined dark:text-champagne/40 dark:hover:text-gold">favorite</button>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="group flex flex-col gap-3">
                         <div class="relative aspect-[9/16] w-full overflow-hidden rounded-[1.5rem] border-[6px] border-maroon/5 bg-gray-100 shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 dark:border-gold/10 dark:bg-gray-800">
                            <img alt="Golden Hour" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDkXecOj7dXiv36wT5oijfr-UnXtLWaaKf0w8ymQTHrQCW_J8lzIVKtQetHB1Dq9e2VzqP7t9FFTPkRM6yvFKZMXf9OFpR_xXu7yc4gMFWA76BJ5c_Dvl8lnnfI0s96ABUXrcqbJ-UG1oDhxJEeaBoHh92YqnsHIkDZqgzaipgxfz3eEvLZoukl1Lub6aBDG141y4crLXw_VJh5fzZgMl_cB119WmIvAM7M4txLypmPnb2l2uy7m5tEQHbKQf_1rbet6aUPiYSxXnjF">
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-maroon/80 dark:bg-obsidian/80 opacity-0 transition-opacity duration-300 group-hover:opacity-100 backdrop-blur-[2px]">
                                <button class="rounded-full bg-white px-8 py-3 text-sm font-bold text-maroon shadow-lg hover:bg-gold hover:text-obsidian transition-colors transform hover:scale-105">
                                    Preview
                                </button>
                            </div>
                            <div class="absolute top-4 left-4 rounded-full bg-maroon px-3 py-1 text-[10px] font-bold text-white shadow-md border border-white/20">
                                BESTSELLER
                            </div>
                        </div>
                        <div class="flex justify-between items-start px-1">
                            <div>
                                <h3 class="font-bold font-display text-maroon dark:text-white leading-tight">Golden Hour</h3>
                                <p class="text-xs font-medium font-sans text-maroon/60 dark:text-champagne/60 mt-1">Regal • Luxury</p>
                            </div>
                            <button class="text-maroon hover:text-maroon transition-colors material-symbols-outlined font-filled dark:text-gold">favorite</button>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="group flex flex-col gap-3">
                         <div class="relative aspect-[9/16] w-full overflow-hidden rounded-[1.5rem] border-[6px] border-maroon/5 bg-gray-100 shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 dark:border-gold/10 dark:bg-gray-800">
                            <img alt="Modern Floral" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC0D3ywsKJRz3iIbX5Eon_OS82IQYwV_HdBtWQ-CSSBeFEly2v0LHKesGWp99NcIwqfH35SJXiNjv2Ib53wJ4UVTep7TceYI5L4yTIrYJUMW5v7o4YY9PGEG2P5ntouX6vsC0HL8wBdyacmdIHYdYrnA_wrQLMCY7pDkR_BrX60aDbl0c2LMzaaZPCAXV8T8Efcdi3z9ucmi3d3y4eWD1olBIp2EoNAS-9MEd9e3mL8IZcE2hnzLB_guptWViQeX-2M9GehfHxfyTkv">
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-maroon/80 dark:bg-obsidian/80 opacity-0 transition-opacity duration-300 group-hover:opacity-100 backdrop-blur-[2px]">
                                <button class="rounded-full bg-white px-8 py-3 text-sm font-bold text-maroon shadow-lg hover:bg-gold hover:text-obsidian transition-colors transform hover:scale-105">
                                    Preview
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-start px-1">
                            <div>
                                <h3 class="font-bold font-display text-maroon dark:text-white leading-tight">Modern Floral</h3>
                                <p class="text-xs font-medium font-sans text-maroon/60 dark:text-champagne/60 mt-1">Modern</p>
                            </div>
                            <button class="text-maroon/40 hover:text-maroon transition-colors material-symbols-outlined dark:text-champagne/40 dark:hover:text-gold">favorite</button>
                        </div>
                    </div>

                    <!-- Card 5 (Emerald) -->
                     <div class="group flex flex-col gap-3">
                         <div class="relative aspect-[9/16] w-full overflow-hidden rounded-[1.5rem] border-[6px] border-maroon/5 bg-gray-100 shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 dark:border-gold/10 dark:bg-gray-800">
                            <img alt="Emerald Elegance" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOIoM51ip6cnXAlQv379-G7JIiMPCGmBV-56swz3OJ5QFiW2ekTxxsZDPh0sF8we-38cTSZedBq-0qqNUdZlPmHjjqMpscEwPBmFN3lCb1pzVI5Li-AuLu6HxBU65eED9ndh93ygTdtmpxlK31Bq_opx6_nVtTr7cpoZay0a8LjymwNvNBPNGpPTzOE50GfqlUBq2IfEhUmynD3TCEPi-nYHJxCC6IBAqLZMbJ4lP2XMgUQM4Qxu7fCOR8-_F_oCMEmeZmcHRB0sXg">
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-maroon/80 dark:bg-obsidian/80 opacity-0 transition-opacity duration-300 group-hover:opacity-100 backdrop-blur-[2px]">
                                <button class="rounded-full bg-white px-8 py-3 text-sm font-bold text-maroon shadow-lg hover:bg-gold hover:text-obsidian transition-colors transform hover:scale-105">
                                    Preview
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-start px-1">
                            <div>
                                <h3 class="font-bold font-display text-maroon dark:text-white leading-tight">Emerald Elegance</h3>
                                <p class="text-xs font-medium font-sans text-maroon/60 dark:text-champagne/60 mt-1">Regal • Green</p>
                            </div>
                            <button class="text-maroon/40 hover:text-maroon transition-colors material-symbols-outlined dark:text-champagne/40 dark:hover:text-gold">favorite</button>
                        </div>
                    </div>

                    <!-- Card 6 (Blush) -->
                    <div class="group flex flex-col gap-3">
                         <div class="relative aspect-[9/16] w-full overflow-hidden rounded-[1.5rem] border-[6px] border-maroon/5 bg-gray-100 shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 dark:border-gold/10 dark:bg-gray-800">
                            <img alt="Blush Romance" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCPf8EG2XIQhSIo1V5ncMe7VKnPgjstE1tEMgit6WGUWcvbSXhIjMxPr2uT2gH8BwVfU8hlhhzA4RhwUg6SAhJOVQNZfcIM9X9xJKLIM2uX1m8OBcO4lfhtkdZ4dioIRiqHkRNw_Xj10d5I0ow9jzn9QHO5-FwO-rl2A31u87anUXWqcaGim5W6-nlCYjlWirQdBM4eRXTTWy-cS7sbqMFj_Pyz-R1bYwJhbAAWLxtFtRnvcwcD5y99zKr7HtWQq-fwyGrmWCOtoZ6r">
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-maroon/80 dark:bg-obsidian/80 opacity-0 transition-opacity duration-300 group-hover:opacity-100 backdrop-blur-[2px]">
                                <button class="rounded-full bg-white px-8 py-3 text-sm font-bold text-maroon shadow-lg hover:bg-gold hover:text-obsidian transition-colors transform hover:scale-105">
                                    Preview
                                </button>
                            </div>
                            <div class="absolute top-4 right-4 rounded-full bg-obsidian/60 px-3 py-1 text-[10px] font-bold text-white backdrop-blur-sm border border-white/10">
                                NEW
                            </div>
                        </div>
                        <div class="flex justify-between items-start px-1">
                            <div>
                                <h3 class="font-bold font-display text-maroon dark:text-white leading-tight">Blush Romance</h3>
                                <p class="text-xs font-medium font-sans text-maroon/60 dark:text-champagne/60 mt-1">Minimal • Pastel</p>
                            </div>
                            <button class="text-maroon/40 hover:text-maroon transition-colors material-symbols-outlined dark:text-champagne/40 dark:hover:text-gold">favorite</button>
                        </div>
                    </div>
                </div>

                <!-- Load More -->
                <div class="mt-8 flex justify-center">
                    <button class="flex items-center gap-2 rounded-lg border border-maroon/20 bg-transparent px-8 py-3 text-sm font-bold text-maroon transition-all hover:bg-maroon/5 dark:text-gold dark:border-gold/20 dark:hover:bg-gold/10">
                        Load More Templates
                        <span class="material-symbols-outlined text-sm">expand_more</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
