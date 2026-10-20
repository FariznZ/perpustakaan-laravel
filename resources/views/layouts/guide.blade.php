@auth
@php
    $isAdmin = auth()->user()->isAdmin();
    $pageKey = request()->route()?->getName() ?? 'default';
    $pageGuide = config('guides.'.$pageKey, config('guides.default'));
    $guideSteps = $pageGuide['steps'] ?? [];

    foreach ($guideSteps as &$step) {
        if ($isAdmin && isset($step['description_admin'])) {
            $step['description'] = $step['description_admin'];
        } elseif (! $isAdmin && isset($step['description_petugas'])) {
            $step['description'] = $step['description_petugas'];
        }

        unset($step['description_admin'], $step['description_petugas']);
    }
    unset($step);

    $guideSteps[] = [
        'icon' => '❓',
        'title' => 'Buka panduan kapan saja',
        'description' => 'Panduan halaman ini selesai. Klik tombol Panduan di navbar untuk membukanya lagi kapan saja.',
        'target' => '[data-guide-start]',
        'placement' => 'bottom',
    ];

    $guideSeen = \Illuminate\Support\Facades\DB::table('user_guide_progress')
        ->where('user_id', auth()->id())
        ->where('page_key', $pageKey)
        ->whereNotNull('seen_at')
        ->exists();
@endphp

<div
    id="app-guide"
    class="fixed inset-0 z-[9999] hidden"
    data-auto-start="{{ $guideSeen ? '0' : '1' }}"
    data-page-key="{{ $pageKey }}"
    data-mark-seen-url="{{ route('guide.seen') }}"
    data-csrf="{{ csrf_token() }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="guide-title"
>
    <div id="guide-backdrop" class="absolute inset-0 bg-gray-950/60"></div>

    <div
        id="guide-spotlight"
        class="pointer-events-none absolute hidden rounded-xl border-2 border-white/90 shadow-[0_0_0_9999px_rgba(15,23,42,0.62)] transition-all duration-200"
        aria-hidden="true"
    ></div>

    <div
        id="guide-card"
        class="absolute z-10 max-h-[calc(100vh-2rem)] w-[calc(100vw-2rem)] max-w-sm overflow-y-auto rounded-2xl bg-white p-5 shadow-2xl ring-1 ring-black/5 transition-all duration-200"
        style="left: 50%; top: 50%; transform: translate(-50%, -50%);"
    >
        <div class="flex items-start justify-between gap-4">
            <div class="flex min-w-0 items-start gap-3">
                <div id="guide-icon" class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-primary-50 text-lg text-primary-600">👋</div>
                <div class="min-w-0">
                    <p id="guide-step-label" class="text-[10px] font-bold uppercase tracking-wider text-primary-600">Langkah 1</p>
                    <h2 id="guide-title" class="mt-0.5 text-base font-bold leading-snug text-gray-900 sm:text-lg">Selamat datang</h2>
                </div>
            </div>
            <button id="guide-close" type="button" class="-m-1.5 flex-shrink-0 rounded-lg p-1.5 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-700" aria-label="Tutup panduan">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <p id="guide-description" class="mt-3 text-sm leading-relaxed text-gray-600"></p>

        <div id="guide-dots" class="mt-4 flex items-center justify-center gap-1.5" aria-hidden="true"></div>

        <div class="mt-4 flex items-center justify-between gap-3">
            <button id="guide-skip" type="button" class="text-xs font-semibold text-gray-500 transition-colors hover:text-gray-700">Lewati</button>
            <div class="flex items-center gap-2">
                <button id="guide-prev" type="button" class="rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-600 transition-colors hover:bg-gray-200 disabled:pointer-events-none disabled:opacity-40">Kembali</button>
                <button id="guide-next" type="button" class="rounded-lg bg-primary-600 px-4 py-2 text-xs font-bold text-white shadow-sm transition-colors hover:bg-primary-700">Lanjut</button>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const guide = document.getElementById('app-guide');
        if (!guide) return;

        const allSteps = @json($guideSteps);
        const backdrop = document.getElementById('guide-backdrop');
        const spotlight = document.getElementById('guide-spotlight');
        const card = document.getElementById('guide-card');
        const icon = document.getElementById('guide-icon');
        const stepLabel = document.getElementById('guide-step-label');
        const title = document.getElementById('guide-title');
        const description = document.getElementById('guide-description');
        const dots = document.getElementById('guide-dots');
        const prevButton = document.getElementById('guide-prev');
        const nextButton = document.getElementById('guide-next');
        const skipButton = document.getElementById('guide-skip');
        const closeButton = document.getElementById('guide-close');

        let steps = [];
        let index = 0;
        let isOpen = false;
        let lastTrigger = null;
        let markSeenSent = false;

        const isMobile = () => window.matchMedia('(max-width: 767px)').matches;

        function resolveTarget(step) {
            if (!step.target) return null;

            const selector = isMobile() && step.mobileTarget ? step.mobileTarget : step.target;
            return document.querySelector(selector);
        }

        function isVisible(element) {
            if (!element) return false;

            const rect = element.getBoundingClientRect();

            return rect.width > 0 && rect.height > 0 && element.getClientRects().length > 0;
        }

        function availableSteps() {
            return allSteps.filter((step) => {
                if (!step.target) return true;

                return isVisible(resolveTarget(step));
            });
        }

        function renderDots() {
            dots.innerHTML = '';

            steps.forEach((_, dotIndex) => {
                const dot = document.createElement('span');

                dot.style.height = '6px';
                dot.style.borderRadius = '9999px';
                dot.style.transition = 'all 0.2s ease';
                dot.style.width = dotIndex === index ? '20px' : '6px';
                dot.style.backgroundColor = dotIndex === index ? '#0284c7' : '#e5e7eb';

                dots.appendChild(dot);
            });
        }

        function showCenter() {
            spotlight.classList.add('hidden');
            backdrop.classList.remove('hidden');

            card.style.width = '';
            card.style.maxWidth = '';
            card.style.left = '50%';
            card.style.top = '50%';
            card.style.transform = 'translate(-50%, -50%)';
        }

        function positionCard(target, step) {
            const rect = target.getBoundingClientRect();
            const padding = 6;

            backdrop.classList.add('hidden');
            spotlight.classList.remove('hidden');
            spotlight.style.left = Math.max(0, rect.left - padding) + 'px';
            spotlight.style.top = Math.max(0, rect.top - padding) + 'px';
            spotlight.style.width = (rect.width + padding * 2) + 'px';
            spotlight.style.height = (rect.height + padding * 2) + 'px';

            if (isMobile()) {
                card.style.width = (window.innerWidth - 32) + 'px';
                card.style.maxWidth = 'none';
                card.style.left = '16px';
                card.style.top = Math.max(16, window.innerHeight - card.offsetHeight - 16) + 'px';
                card.style.transform = 'none';

                return;
            }

            card.style.width = '';
            card.style.maxWidth = '';

            const gap = 16;
            const cardWidth = card.offsetWidth;
            const cardHeight = card.offsetHeight;
            const viewportWidth = window.innerWidth;
            const viewportHeight = window.innerHeight;
            const placements = {
                bottom: {
                    left: rect.left + rect.width / 2 - cardWidth / 2,
                    top: rect.bottom + gap,
                    fits: rect.bottom + gap + cardHeight <= viewportHeight - 12,
                },
                top: {
                    left: rect.left + rect.width / 2 - cardWidth / 2,
                    top: rect.top - cardHeight - gap,
                    fits: rect.top - cardHeight - gap >= 12,
                },
                right: {
                    left: rect.right + gap,
                    top: rect.top + rect.height / 2 - cardHeight / 2,
                    fits: rect.right + gap + cardWidth <= viewportWidth - 12,
                },
                left: {
                    left: rect.left - cardWidth - gap,
                    top: rect.top + rect.height / 2 - cardHeight / 2,
                    fits: rect.left - cardWidth - gap >= 12,
                },
            };

            const preferred = placements[step.placement] && placements[step.placement].fits
                ? step.placement
                : ['bottom', 'top', 'right', 'left'].find((placement) => placements[placement].fits);
            const position = preferred ? placements[preferred] : null;

            if (!position) {
                showCenter();

                return;
            }

            const left = Math.min(Math.max(12, position.left), viewportWidth - cardWidth - 12);
            const top = Math.min(Math.max(12, position.top), viewportHeight - cardHeight - 12);

            card.style.left = left + 'px';
            card.style.top = top + 'px';
            card.style.transform = 'none';
        }

        function positionCurrentStep() {
            if (!isOpen) return;

            const step = steps[index];
            const target = resolveTarget(step);

            if (target && isVisible(target)) {
                positionCard(target, step);
            } else {
                showCenter();
            }
        }

        function showStep(stepIndex) {
            index = stepIndex;

            const step = steps[index];

            icon.textContent = step.icon || '💡';
            stepLabel.textContent = 'Langkah ' + (index + 1) + ' dari ' + steps.length;
            title.textContent = step.title;
            description.textContent = step.description;
            prevButton.disabled = index === 0;
            prevButton.classList.toggle('invisible', index === 0);
            nextButton.textContent = index === steps.length - 1 ? 'Selesai' : 'Lanjut';

            renderDots();

            const target = resolveTarget(step);

            if (target && isVisible(target)) {
                const rect = target.getBoundingClientRect();

                if (rect.top < 80 || rect.bottom > window.innerHeight - 80) {
                    target.scrollIntoView({ block: 'center', inline: 'center' });
                }

                positionCard(target, step);
            } else {
                showCenter();
            }

            window.requestAnimationFrame(() => {
                if (isOpen) {
                    positionCurrentStep();
                }
            });
        }

        function markGuideSeen() {
            if (markSeenSent) return;

            markSeenSent = true;

            fetch(guide.dataset.markSeenUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': guide.dataset.csrf,
                },
                body: JSON.stringify({ page_key: guide.dataset.pageKey }),
            }).catch(() => {
                markSeenSent = false;
            });
        }

        function closeGuide(markSeen = true) {
            if (!isOpen) return;

            isOpen = false;
            guide.classList.add('hidden');

            if (markSeen) {
                markGuideSeen();
            }

            if (lastTrigger && typeof lastTrigger.focus === 'function') {
                lastTrigger.focus();
            }
        }

        function startGuide(trigger = null) {
            lastTrigger = trigger;
            steps = availableSteps();

            if (!steps.length) return;

            index = 0;
            isOpen = true;
            guide.classList.remove('hidden');

            showStep(0);

            window.requestAnimationFrame(() => nextButton.focus());
        }

        function goNext() {
            if (index < steps.length - 1) {
                showStep(index + 1);
            } else {
                closeGuide();
            }
        }

        function goPrevious() {
            if (index > 0) {
                showStep(index - 1);
            }
        }

        document.querySelectorAll('[data-guide-start]').forEach((button) => {
            button.addEventListener('click', () => startGuide(button));
        });

        nextButton.addEventListener('click', goNext);
        prevButton.addEventListener('click', goPrevious);
        skipButton.addEventListener('click', () => closeGuide());
        closeButton.addEventListener('click', () => closeGuide());

        backdrop.addEventListener('click', () => closeGuide());

        document.addEventListener('keydown', (event) => {
            if (!isOpen) return;

            if (event.key === 'Escape') {
                closeGuide();
            } else if (event.key === 'ArrowRight') {
                goNext();
            } else if (event.key === 'ArrowLeft') {
                goPrevious();
            }
        });

        window.addEventListener('resize', positionCurrentStep);
        window.addEventListener('scroll', positionCurrentStep, true);

        window.startGuide = startGuide;

        if (guide.dataset.autoStart === '1') {
            window.setTimeout(() => startGuide(), 500);
        }
    })();
</script>
@endauth
