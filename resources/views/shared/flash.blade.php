@if (session('success'))
<div class="max-w-lg">
    <div id="flash-message"
        class="relative w-full rounded-lg border px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7 bg-background text-foreground">
        <div class="text-sm [&_p]:leading-relaxed">
            {{ session("success") }}
        </div>
    </div>
</div>
@endif
