@if(config('devtools.enabled'))
<script>
(function () {
    const CSRF = '{{ csrf_token() }}';
    const commands = @json(config('devtools.commands'));

    function toast(msg, err = false) {
        const el = document.createElement('div');
        el.innerText = msg;
        el.style.position = 'fixed';
        el.style.bottom = '20px';
        el.style.right = '20px';
        el.style.background = err ? '#dc2626' : '#16a34a';
        el.style.color = '#fff';
        el.style.padding = '10px';
        el.style.zIndex = 99999;
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 2000);
    }

    function run(route) {
        fetch('/devtools' + route, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json'
            }
        }).then(r => r.json()).then(d => {
            toast(d.message, !d.success);
        }).catch(e => toast(e.message, true));
    }

    document.addEventListener('keydown', function (e) {
        if (!e.altKey) return;
        const k = e.key.toLowerCase();
        if (!commands[k]) return;
        e.preventDefault();
        run(commands[k].route);
    });
})();
</script>
@endif
