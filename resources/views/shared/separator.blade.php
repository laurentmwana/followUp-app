@php
$orientation ??= 'horizontal';
$class ??= ''
@endphp

<div @class(['shrink-0 bg-border', 'h-[1px] w-full'=> $orientation === 'horizontal', 'h-full w-[1px]' => $orientation
    === 'vertical', $class])></div>
