{{--@can('plans-edit')--}}
<x-form :route="route('plans.change', $row->id)" :button="false">
    {{ method_field('PATCH') }}
    <input type="hidden" name="field" value="default">
    <div class="form-check form-check-inline form-switch">
        <input type="checkbox" class="form-check-input" name="default" {{ $row->default == 1 ? 'checked' : '' }}
            onChange="event.preventDefault(); this.closest('form').submit();" @disabled($row->default == 1 )>
    </div>
</x-form>
{{--@endcan--}}
