{{--@can('plans-edit')--}}
<x-form :route="route('plans.change', $row->id)" :button="false">
    {{ method_field('PATCH') }}
    <input type="hidden" name="field" value="is_popular">
    <div class="form-check form-check-inline form-switch">
        <input type="checkbox" class="form-check-input" name="is_popular" {{ $row->is_popular == 1 ? 'checked' : '' }}
            onChange="event.preventDefault(); this.closest('form').submit();">
    </div>
</x-form>
{{--@endcan--}}
