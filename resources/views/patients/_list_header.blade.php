<div class="box level">
    <div class="level-left">
        <div class="level-item">
            {!! link_to_with_icon('fas fa-arrow-left fa-2x', 'home', [], 'Back to Home', 'has-text-info') !!}
        </div>

        {{ $slot }}
    </div>


    @can ('create', \App\Patient::class)
        <div class="level-right">
            <div class="level-item">
                {!! link_to_with_icon('fas fa-plus fa-2x', 'patients.create', [], 'Create a new Patient', 'has-text-success') !!}
            </div>
        </div>
    @endcan
</div>