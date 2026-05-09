<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BinniTaxi | Mototaxi de confianza para tu comunidad</title>
        <meta
            name="description"
            content="BinniTaxi ayuda a pasajeros y conductores de pueblos y comunidades a organizar el servicio de mototaxi de forma rápida, cercana y confiable."
        >

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-background text-foreground">
        <div class="relative overflow-hidden">
            <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-96 bg-[radial-gradient(circle_at_top,_rgba(46,139,87,0.24),_transparent_58%)]"></div>
            <div class="pointer-events-none absolute right-[-8rem] top-40 -z-10 h-72 w-72 rounded-full bg-brand-200/60 blur-3xl"></div>

            <header class="mx-auto flex max-w-6xl items-center justify-between px-6 py-5 lg:px-8">
                <a href="#" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-500 text-sm font-black tracking-[0.2em] text-white shadow-lg shadow-brand-500/25">
                        BT
                    </span>
                    <span class="text-lg font-semibold tracking-tight">BinniTaxi</span>
                </a>

                <nav class="hidden items-center gap-6 text-sm text-foreground/80 md:flex">
                    <a href="#como-funciona" class="transition hover:text-brand-700">Como funciona</a>
                    <a href="#pasajeros" class="transition hover:text-brand-700">Pasajeros</a>
                    <a href="#conductores" class="transition hover:text-brand-700">Conductores</a>
                </nav>

                <a
                    href="https://wa.me/?text=Hola%20quiero%20conocer%20BinniTaxi"
                    class="inline-flex items-center rounded-full border border-brand-200 bg-white px-4 py-2 text-sm font-semibold text-brand-800 shadow-sm transition hover:border-brand-300 hover:bg-brand-50"
                >
                    Hablar por WhatsApp
                </a>
            </header>

            <main>
                <section class="mx-auto grid max-w-6xl gap-12 px-6 pb-20 pt-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8 lg:pb-28 lg:pt-12">
                    <div class="max-w-2xl">
                        <span class="inline-flex items-center rounded-full border border-brand-200 bg-brand-50 px-4 py-2 text-sm font-medium text-brand-800">
                            Hecho para pueblos y comunidades
                        </span>

                        <h1 class="mt-6 max-w-xl text-5xl font-black tracking-tight text-balance text-foreground sm:text-6xl">
                            Tu mototaxi de confianza en el pueblo
                        </h1>

                        <p class="mt-6 max-w-xl text-lg leading-8 text-foreground/75">
                            Pide tu viaje por WhatsApp de forma rapida y sencilla. BinniTaxi ayuda a los pasajeros a moverse
                            con facilidad y a los conductores a trabajar con mas orden.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            <a
                                href="https://wa.me/?text=Hola%20quiero%20pedir%20un%20mototaxi%20con%20BinniTaxi"
                                class="inline-flex items-center justify-center rounded-full bg-brand-500 px-6 py-3 text-base font-semibold text-white shadow-lg shadow-brand-500/25 transition hover:bg-brand-600"
                            >
                                Pedir por WhatsApp
                            </a>
                            <a
                                href="#conductores"
                                class="inline-flex items-center justify-center rounded-full border border-brand-300 bg-white px-6 py-3 text-base font-semibold text-brand-800 transition hover:bg-brand-50"
                            >
                                Quiero ser conductor
                            </a>
                        </div>

                        <div class="mt-10 grid gap-4 sm:grid-cols-3">
                            <div class="rounded-3xl border border-brand-100 bg-white/90 p-5 shadow-sm">
                                <p class="text-2xl font-black text-brand-700">WhatsApp</p>
                                <p class="mt-2 text-sm leading-6 text-foreground/70">Los pasajeros piden su viaje desde la app que ya usan todos los dias.</p>
                            </div>
                            <div class="rounded-3xl border border-brand-100 bg-white/90 p-5 shadow-sm">
                                <p class="text-2xl font-black text-brand-700">App</p>
                                <p class="mt-2 text-sm leading-6 text-foreground/70">Los conductores reciben y organizan servicios con mas claridad.</p>
                            </div>
                            <div class="rounded-3xl border border-brand-100 bg-white/90 p-5 shadow-sm">
                                <p class="text-2xl font-black text-brand-700">Comunidad</p>
                                <p class="mt-2 text-sm leading-6 text-foreground/70">Un servicio mas cercano, rapido y confiable para el pueblo.</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-x-10 top-8 h-48 rounded-full bg-brand-300/35 blur-3xl"></div>
                        <div class="relative overflow-hidden rounded-[2rem] border border-brand-200 bg-white p-3 shadow-[0_20px_60px_rgba(20,64,42,0.12)]">
                            <img
                                src="{{ asset('images/landing/binnitaxi-mototaxi-pueblo-whatsapp.webp') }}"
                                alt="BinniTaxi mostrando un mototaxi y la solicitud de viaje por WhatsApp"
                                width="1536"
                                height="1024"
                                fetchpriority="high"
                                class="h-auto w-full rounded-[1.5rem] object-cover"
                            >

                            <div class="absolute bottom-7 left-7 right-7 rounded-[1.5rem] border border-white/30 bg-brand-950/88 p-5 text-white shadow-xl backdrop-blur-sm">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.2em] text-brand-200">BinniTaxi</p>
                                        <p class="mt-2 text-lg font-bold">Pasajeros por WhatsApp, conductores con app</p>
                                    </div>
                                    <span class="inline-flex items-center rounded-full bg-white/12 px-3 py-1 text-xs font-semibold">
                                        Servicio para pueblos
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="como-funciona" class="border-y border-brand-100 bg-white/80">
                    <div class="mx-auto max-w-6xl px-6 py-20 lg:px-8">
                        <div class="max-w-2xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-700">Como funciona</p>
                            <h2 class="mt-3 text-3xl font-black tracking-tight text-balance sm:text-4xl">
                                Asi de facil funciona BinniTaxi
                            </h2>
                        </div>

                        <div class="mt-12 grid gap-6 lg:grid-cols-3">
                            <article class="rounded-[1.75rem] border border-brand-100 bg-brand-50 p-7 shadow-sm">
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-500 text-lg font-black text-white">1</span>
                                <h3 class="mt-6 text-xl font-bold">Escribenos por WhatsApp</h3>
                                <p class="mt-3 leading-7 text-foreground/75">
                                    El pasajero solicita su viaje de forma simple, sin complicarse con aplicaciones dificiles.
                                </p>
                            </article>
                            <article class="rounded-[1.75rem] border border-brand-100 bg-white p-7 shadow-sm">
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-600 text-lg font-black text-white">2</span>
                                <h3 class="mt-6 text-xl font-bold">Asignamos un conductor</h3>
                                <p class="mt-3 leading-7 text-foreground/75">
                                    El servicio se organiza de forma mas clara para encontrar una unidad disponible.
                                </p>
                            </article>
                            <article class="rounded-[1.75rem] border border-brand-100 bg-white p-7 shadow-sm">
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-700 text-lg font-black text-white">3</span>
                                <h3 class="mt-6 text-xl font-bold">Muevete con confianza</h3>
                                <p class="mt-3 leading-7 text-foreground/75">
                                    Mas rapidez para el pasajero y mejor control para el conductor en cada viaje.
                                </p>
                            </article>
                        </div>
                    </div>
                </section>

                <section id="pasajeros" class="mx-auto max-w-6xl px-6 py-20 lg:px-8">
                    <div class="grid gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
                        <div class="rounded-[2rem] border border-brand-100 bg-brand-900 p-8 text-white shadow-[0_20px_50px_rgba(20,64,42,0.16)]">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-200">Para pasajeros</p>
                            <h2 class="mt-4 text-3xl font-black tracking-tight text-balance">Mas facil para quienes necesitan moverse todos los dias</h2>
                            <p class="mt-4 leading-7 text-white/76">
                                BinniTaxi esta hecho para personas que solo quieren pedir su viaje rapido y seguir con su dia.
                            </p>

                            <div class="mt-8 grid gap-3">
                                <div class="rounded-2xl bg-white/10 p-4">Pide tu mototaxi por WhatsApp en minutos</div>
                                <div class="rounded-2xl bg-white/10 p-4">Un servicio mas claro y confiable</div>
                                <div class="rounded-2xl bg-white/10 p-4">Ideal para trayectos cortos dentro del pueblo</div>
                                <div class="rounded-2xl bg-white/10 p-4">Sin procesos complicados ni registros dificiles</div>
                            </div>
                        </div>

                        <div class="grid gap-5">
                            <div class="rounded-[1.75rem] border border-brand-100 bg-white p-6 shadow-sm">
                                <p class="text-sm font-semibold text-brand-700">Atencion cercana</p>
                                <p class="mt-2 leading-7 text-foreground/75">
                                    La experiencia esta pensada para comunidades donde la rapidez y la confianza importan mas que una app llena de funciones innecesarias.
                                </p>
                            </div>
                            <div class="rounded-[1.75rem] border border-brand-100 bg-brand-50 p-6 shadow-sm">
                                <p class="text-sm font-semibold text-brand-700">La herramienta correcta</p>
                                <p class="mt-2 leading-7 text-foreground/75">
                                    Para el pasajero, WhatsApp ya es suficiente. La barrera de entrada es baja y pedir un viaje se vuelve algo natural.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="conductores" class="bg-white/70">
                    <div class="mx-auto max-w-6xl px-6 py-20 lg:px-8">
                        <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-700">Para conductores</p>
                                <h2 class="mt-4 text-3xl font-black tracking-tight text-balance sm:text-4xl">
                                    Mas orden y mas control para los conductores
                                </h2>
                                <p class="mt-4 max-w-2xl leading-7 text-foreground/75">
                                    La app para conductores ayuda a trabajar con mas claridad, menos desorden y mejor atencion al pasajero.
                                </p>

                                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                                    <div class="rounded-[1.5rem] border border-brand-100 bg-white p-5 shadow-sm">
                                        <p class="font-semibold text-brand-800">Servicios organizados</p>
                                        <p class="mt-2 text-sm leading-6 text-foreground/70">Recibe viajes de forma mas clara y sin depender solo del boca a boca.</p>
                                    </div>
                                    <div class="rounded-[1.5rem] border border-brand-100 bg-white p-5 shadow-sm">
                                        <p class="font-semibold text-brand-800">Mejor seguimiento</p>
                                        <p class="mt-2 text-sm leading-6 text-foreground/70">Consulta mejor tus viajes y mantente al tanto del servicio.</p>
                                    </div>
                                    <div class="rounded-[1.5rem] border border-brand-100 bg-white p-5 shadow-sm">
                                        <p class="font-semibold text-brand-800">Operacion diaria</p>
                                        <p class="mt-2 text-sm leading-6 text-foreground/70">La herramienta esta pensada para el trabajo real de todos los dias.</p>
                                    </div>
                                    <div class="rounded-[1.5rem] border border-brand-100 bg-white p-5 shadow-sm">
                                        <p class="font-semibold text-brand-800">Mas confianza</p>
                                        <p class="mt-2 text-sm leading-6 text-foreground/70">Forma parte de un servicio mas confiable para la comunidad.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-[2rem] border border-brand-200 bg-brand-50 p-6 shadow-sm">
                                <div class="rounded-[1.5rem] border border-brand-100 bg-white p-6">
                                    <div class="flex items-center justify-between border-b border-brand-100 pb-4">
                                        <div>
                                            <p class="text-sm font-semibold text-brand-800">App del conductor</p>
                                            <p class="text-sm text-foreground/60">Panel simple para el trabajo diario</p>
                                        </div>
                                        <span class="rounded-full bg-brand-100 px-3 py-1 text-xs font-semibold text-brand-800">Activa</span>
                                    </div>

                                    <div class="mt-5 space-y-4">
                                        <div class="rounded-2xl border border-brand-100 p-4">
                                            <div class="flex items-center justify-between">
                                                <p class="font-semibold">Viaje al mercado</p>
                                                <span class="text-sm text-brand-700">Nuevo</span>
                                            </div>
                                            <p class="mt-2 text-sm text-foreground/65">Salida: Centro</p>
                                        </div>
                                        <div class="rounded-2xl border border-brand-100 p-4">
                                            <div class="flex items-center justify-between">
                                                <p class="font-semibold">Viaje a la colonia</p>
                                                <span class="text-sm text-brand-700">En curso</span>
                                            </div>
                                            <p class="mt-2 text-sm text-foreground/65">Salida: Mercado municipal</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto max-w-6xl px-6 py-20 lg:px-8">
                    <div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
                        <div class="rounded-[2rem] border border-brand-100 bg-brand-50 p-8">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-700">Pensado para pueblos</p>
                            <h2 class="mt-4 text-3xl font-black tracking-tight text-balance">
                                Una solucion hecha para la realidad de tu comunidad
                            </h2>
                        </div>

                        <div class="rounded-[2rem] border border-brand-100 bg-white p-8 shadow-sm">
                            <p class="leading-8 text-foreground/75">
                                BinniTaxi no fue pensado para grandes ciudades. Fue pensado para pueblos, comunidades y zonas donde la gente necesita un transporte cercano, rapido y confiable.
                            </p>

                            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                                <div class="rounded-2xl bg-brand-50 px-4 py-3 font-medium text-brand-900">Atencion cercana</div>
                                <div class="rounded-2xl bg-brand-50 px-4 py-3 font-medium text-brand-900">Trayectos cortos y frecuentes</div>
                                <div class="rounded-2xl bg-brand-50 px-4 py-3 font-medium text-brand-900">Uso simple para pasajeros</div>
                                <div class="rounded-2xl bg-brand-50 px-4 py-3 font-medium text-brand-900">Mejor organizacion del servicio</div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="px-6 pb-20 lg:px-8 lg:pb-28">
                    <div class="mx-auto max-w-6xl rounded-[2.5rem] bg-brand-900 px-8 py-12 text-white shadow-[0_20px_70px_rgba(20,64,42,0.22)] lg:px-12">
                        <div class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-200">BinniTaxi</p>
                                <h2 class="mt-4 text-3xl font-black tracking-tight text-balance sm:text-4xl">
                                    Lleva un servicio de mototaxi mas organizado a tu comunidad
                                </h2>
                                <p class="mt-4 max-w-2xl leading-7 text-white/76">
                                    Ya sea que quieras pedir un viaje o formar parte del equipo de conductores, BinniTaxi esta hecho para servir mejor a tu pueblo.
                                </p>
                            </div>

                            <div class="flex flex-col gap-3 lg:items-end">
                                <a
                                    href="https://wa.me/?text=Hola%20quiero%20hablar%20sobre%20BinniTaxi"
                                    class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-base font-semibold text-brand-900 transition hover:bg-brand-50"
                                >
                                    Hablar por WhatsApp
                                </a>
                                <a
                                    href="#conductores"
                                    class="inline-flex items-center justify-center rounded-full border border-white/20 px-6 py-3 text-base font-semibold text-white transition hover:bg-white/10"
                                >
                                    Registrarme como conductor
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="border-t border-brand-100 bg-white/80">
                <div class="mx-auto flex max-w-6xl flex-col gap-2 px-6 py-6 text-sm text-foreground/65 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                    <p class="font-semibold text-foreground">BinniTaxi</p>
                    <p>Servicio de mototaxi pensado para pueblos y comunidades.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
