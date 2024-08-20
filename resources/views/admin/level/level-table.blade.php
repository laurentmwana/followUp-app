<table class="mb-4 w-full caption-bottom text-sm responsive-table">
  <thead class="[&_tr]:border-b">
    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
      <th
        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        Promotion
      </th>
      <th
        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        Année academique
      </th>
      <th
        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        Option
      </th>
      <th
        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        Etudiants
      </th>
      <th
        class="h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        Créer
      </th>
    </tr>
  </thead>

  <tbody class="[&_tr:last-child]:border-0">
    @foreach ($levels as $level)
    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
      <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        <a href="{{ route('~level.show', $level) }}" class="hover:underline">
          {{ $level->programme->name }}
        </a>
      </td>

      <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        <a href="{{ route('~level.show', $level) }}" class="hover:underline">
          {{ $level->year->start }} - {{ $level->year->end }}
        </a>
      </td>

      <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        <a href="{{ route('~option.show', $level->option->id) }}" class="hover:underline">
          {{ $level->option->name }}
        </a>
      </td>
      <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        {{ $level->students->count() }}
      </td>
      <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        @include('shared.ago', ['now' => $level->created_at])
      </td>

      <td class="p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]">
        <div class="flex">
          <x-button-link href="{{ route('~level.show', $level) }}">
            <i class="bi bi-eye"></i>
          </x-button-link>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div>
  {{ $levels->links() }}
</div>