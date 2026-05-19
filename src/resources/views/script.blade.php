<script>
document.addEventListener('keydown', function(e) {

    const commands = {
        'c': '/devtools/optimize-clear',
        'm': '/devtools/migrate',
        's': '/devtools/storage-link',
        'q': '/devtools/queue-restart',
        'r': '/devtools/route-clear',
        'v': '/devtools/view-clear',
    };

    if (!e.altKey) {
        return;
    }

    const key = e.key.toLowerCase();

    if (!commands[key]) {
        return;
    }

    e.preventDefault();

    fetch(commands[key], {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {

        showDevToolsToast(data.message);

    });

});

function showDevToolsToast(message)
{
    const toast = document.createElement('div');

    toast.innerText = message;

    toast.style.position = 'fixed';
    toast.style.bottom = '20px';
    toast.style.right = '20px';
    toast.style.background = '#16a34a';
    toast.style.color = '#fff';
    toast.style.padding = '12px 18px';
    toast.style.borderRadius = '8px';
    toast.style.fontSize = '14px';
    toast.style.zIndex = '999999';
    toast.style.boxShadow = '0 4px 10px rgba(0,0,0,0.2)';
    toast.style.opacity = '0';
    toast.style.transition = '0.3s';

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '1';
    }, 100);

    setTimeout(() => {

        toast.style.opacity = '0';

        setTimeout(() => {
            toast.remove();
        }, 300);

    }, 2000);
}
</script>