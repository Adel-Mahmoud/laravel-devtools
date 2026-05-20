@if(config('devtools.enabled'))
<script>
(function () {

    const csrf = '{{ csrf_token() }}';
    const commands = @js(config('devtools.commands'));
    const prefix = '{{ url(config('devtools.prefix')) }}';

    function toast(message, error = false) {

        const oldToast = document.getElementById('devtools-toast');

        if (oldToast) {
            oldToast.remove();
        }

        const toast = document.createElement('div');

        toast.id = 'devtools-toast';

        toast.innerHTML = `
            <div style="
                min-width:260px;
                max-width:420px;
                padding:14px 18px;
                border-radius:12px;
                background:${error ? '#dc2626' : '#16a34a'};
                color:#fff;
                position:fixed;
                bottom:20px;
                right:20px;
                z-index:999999;
                font-family:Arial,sans-serif;
                box-shadow:0 10px 25px rgba(0,0,0,.2);
                font-size:14px;
            ">
                ${message}
            </div>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    async function run(route) {

        try {

            const response = await fetch(prefix + '/' + route, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            toast(data.message, !data.success);

        } catch (error) {

            console.error(error);

            toast(error.message || 'Unknown error', true);
        }
    }

    document.addEventListener('keydown', async (event) => {

        if (!event.altKey) {
            return;
        }

        const key = event.code.replace('Key', '').toLowerCase();

        if (!commands[key]) {
            return;
        }

        event.preventDefault();

        const command = commands[key];

        if (command.confirm) {

            const confirmed = confirm(
                'Are you sure you want to run: ' + command.command + ' ?'
            );

            if (!confirmed) {
                return;
            }
        }

        await run(command.route);

    });

})();
</script>
@endif
