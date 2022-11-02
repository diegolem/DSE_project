@extends(auth()->user()->user_type_id == 'ASI' ? 'layouts.assistant' : 'layouts.mechanic')

@section('page-title', 'Registrar detalle de reparación')

@section('contenido')
    <h3 class="center {{ auth()->user()->user_type_id == 'ASI' ? 'cyan' : 'deep-purple' }}-text text-darken-4">Reparación {{ $repair->code }}</h3>
    <div style="display: flex; justify-content: center; flex-direction: row; margin-bottom: 5%;">
        {{-- <a href="#mdlOwners" class="btn waves-effect waves-light "><i class="material-icons right">contacts</i> Propietarios</a> --}}
        {{-- <a href="#mdlDetails" class="btn waves-effect waves-light "><i class="material-icons right">add</i> Detalles</a> --}}
    </div>
    {{--<h5 class="grey-text">Añadir</h5>--}}

    {!! Form::model($detail, ['name' => 'frmDetail', 'route' => (auth()->user()->user_type_id == 'ASI' ? '' : 'mechanic.') .'details.store', 'method' => 'POST', 'class' => 'row']) !!}

        <div class="input-field col s8 offset-s2">
            {!! Form::text('detail', '', ['id' => 'txtDetail']) !!}
            {!! Form::label('txtDetail', 'Detalle') !!}

            @if ($errors->has('detail'))
                <span class="error-block">
                    <strong>{{ $errors->first('detail') }}</strong>
                </span>
            @endif
        </div>

    <div class="input-field col s8 offset-s2">
        {!! Form::textarea('description', '', ['id' => 'txtDescription', 'class' => 'materialize-textarea']) !!}
        {!! Form::label('txtDescription', 'Descripción') !!}

        @if ($errors->has('description'))
            <span class="error-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>

    <div class="input-field col s8 offset-s2">
        {!! Form::text('amount', '', ['id' => 'txtAmount']) !!}
        {!! Form::label('txtAmount', 'Monto') !!}

        @if ($errors->has('amount'))
            <span class="error-block">
                <strong>{{ $errors->first('amount') }}</strong>
            </span>
        @endif
    </div>

    <div class="input-field col s8 offset-s2">
        {!! Form::date('date', Carbon\Carbon::now(), ['id' => 'txtDate', 'class' => '']) !!}
        {!! Form::label('txtDate', 'Fecha') !!}

        @if ($errors->has('date'))
            <span class="error-block">
                <strong>{{ $errors->first('date') }}</strong>
            </span>
        @endif
    </div>

    <div class="input-field col s8 offset-s2">
        {!! Form::select('categorie_id', $categories, ['id' => 'cmbCategory']) !!}
        {!! Form::label('cmbCategory', 'Categoría') !!}

        @if ($errors->has('date'))
            <span class="error-block">
                <strong>{{ $errors->first('date') }}</strong>
            </span>
        @endif
    </div>

    {!! Form::hidden('repair_id', $repair->id) !!}
    <div class="col s12" style="display: flex; justify-content: center">
        <a href="{{ route('repairs.index') }}" style="margin-right: 5%;" class="btn amber">Regresar</a>
        {!! Form::button('Registrar', ['class' => (auth()->user()->user_type_id == 'ASI' ? '' : 'deep-purple') . " btn waves-effect waves-light", 'type' => 'submit']) !!}
    </div>

    {!! Form::close() !!}
@endsection

@section('script')
    <script>
        let repairDate = new Date("{{ $repair->admissionDate }}");

        $.validator.setDefaults({
            errorClass: 'invalid',
            validClass: 'none',
            errorPlacement: function(error, element) {
                $(element).parent().find('span.helper-text').remove();
                $(element).parent()
                    .append(`<span class='helper-text' data-error='${error.text()}'></span>`);
            }
        });

        $.validator.addMethod('validText', function(value, element) {
            return this.optional(element) || /^([A-Z]|[a-z]|[ñÑ])[a-zA-Z áéíóú,0-9ñÑ.]*$/.test(value);
        }, 'Ingresa un texto válido.');

        $.validator.addMethod("repairDate", function(value, element) {
            return new Date(value) >= repairDate;
        }, "Ingresa una fecha mayor o igual a la del registro de la reparación!");

        $.validator.addMethod("actualDate", function(value, element) {
            return new Date() >= new Date(value);
        }, "Ingresa una fecha menor o igual a la actual!");

        $(frmDetail).validate({
            rules: {
                detail: {
                    required: true,
                    validText: true
                },
                description: {
                    required: true,
                    validText: true
                },
                amount: {
                    required: true,
                    number: true,
                    min: 0
                },
                date: {
                    required: true,
                    repairDate: true,
                    actualDate: true
                },
                categorie_id: 'required'
            },
            messages: {
                detail: {required: 'Ingrese un título para el detalle!'},
                description: {required: 'Ingrese una descripción!'},
                amount: {
                    required: 'Ingrese un monto',
                    number: 'Ingrese una cifra numérica',
                    min: 'Ingrese una cifra positiva'
                },
                date: {
                    required: 'Ingrese una fecha para el detalle',
                },
                categorie_id: 'Debes seleccionar una categoría'
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection