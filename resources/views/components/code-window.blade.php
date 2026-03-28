@props([
    'language' => 'php',
    'filename' => null,
])

@once
    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/tokyo-night-dark.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.code-window-block').forEach(block => {
                    hljs.highlightElement(block);
                });
            });
        </script>
    @endpush
@endonce

<div class="rounded-xl overflow-hidden shadow-lg font-mono text-sm">

    {{-- Window chrome --}}
    <div class="bg-[#1a1b2e] flex items-center justify-between px-4 py-3 border-b border-white/5">
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-[#ff5f57]"></span>
            <span class="w-3 h-3 rounded-full bg-[#febc2e]"></span>
            <span class="w-3 h-3 rounded-full bg-[#28c840]"></span>
        </div>

        @if($filename)
            <span class="text-xs text-gray-500">{{ $filename }}</span>
        @endif

        <button
            onclick="copyCode(this)"
            class="text-xs text-gray-500 hover:text-gray-300 transition flex items-center gap-1.5 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <span>Copy</span>
        </button>
    </div>

    {{-- Code --}}
    <div class="bg-[#1a1b2e] overflow-x-auto">
        <pre class="!m-0 !rounded-none !bg-transparent"><code class="code-window-block language-{{ $language }} !bg-transparent !p-5 block leading-relaxed">{{ trim($slot) }}</code></pre>
    </div>

</div>

@once
    @push('scripts')
        <script>
            function copyCode(btn) {
                const code = btn.closest('.rounded-xl').querySelector('code');
                navigator.clipboard.writeText(code.innerText).then(() => {
                    const span = btn.querySelector('span');
                    span.textContent = 'Copied!';
                    setTimeout(() => span.textContent = 'Copy', 2000);
                });
            }
        </script>
    @endpush
@endonce
