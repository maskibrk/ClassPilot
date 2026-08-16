
    <x-layouts::app.sidebar :title="$title ?? null">

        <flux:main class="bg-zinc-100 dark:bg-zinc-900">
            {{ $slot }}
        </flux:main>

        @if (session('success'))
            <script>
                window.addEventListener('load', () => {
                    Flux.toast({
                        variant: 'success',
                        text: @js(session('success')),
                    });
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                window.addEventListener('load', () => {
                    Flux.toast({
                        variant: 'danger',
                        text: @js(session('error')),
                    });
                });
            </script>
        @endif

        @stack('scripts')

    </x-layouts::app.sidebar>

    @livewireScripts
    @fluxScripts

