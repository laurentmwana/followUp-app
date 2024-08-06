@php
$moyGroup = moyGroupCourse($group->notes);
@endphp

<tr class="border transition-colors hover:bg-muted/50 bg-muted">
    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px] font-semibold">

        Total
    </td>
    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px] font-semibold">
        <div>
            {{ $moyGroup->credits }}
        </div>
    </td>
    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px] font-semibold">
        <div>
            {{ $moyGroup->tn }}
        </div>
    </td>

    <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px] font-semibold">
        <div>
            {{ $moyGroup->cp }}
        </div>
    </td>
</tr>
