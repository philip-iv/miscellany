<div class="form-group">
    <label>{{ __($trans . '.fields.age') }}</label>
    {!! Form::text(
        'age',
        FormCopy::field('name')->string(),
        [
            'placeholder' => __($trans . '.placeholders.age'),
            'class' => 'form-control',
            'maxlength' => 9
        ]
    ) !!}

    @if (isset($bulk) && $bulk)
        <p class="help-block">
            {{ __('crud.bulk.age.helper') }}
        </p>
    @endif
</div>
