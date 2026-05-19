@if(config('devtools.enabled'))
<script>
(function () {
    const csrf = '{{ csrf_token() }}';
    const commands = @json(config('devtools.commands'));

    function toast(msg, err=false){
        const d=document.createElement('div');
        d.innerText=msg;
        d.style.cssText='position:fixed;bottom:20px;right:20px;padding:10px;background:'+(err?'#dc2626':'#16a34a')+';color:#fff;z-index:99999';
        document.body.appendChild(d);
        setTimeout(()=>d.remove(),2000);
    }

    function run(route){
        fetch('/devtools'+route,{
            method:'POST',
            headers:{
                'X-CSRF-TOKEN':csrf,
                'Accept':'application/json'
            }
        })
        .then(r=>r.json())
        .then(d=>toast(d.message,!d.success))
        .catch(e=>toast(e.message,true));
    }

    document.addEventListener('keydown',e=>{
        if(!e.altKey)return;
        const k=e.key.toLowerCase();
        if(!commands[k])return;
        e.preventDefault();
        run(commands[k].route);
    });
})();
</script>
@endif
