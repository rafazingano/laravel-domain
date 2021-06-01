<x-alert/>

<div class="form-group">
    <label class="control-label">Dominio <span class="required"> * </span></label>
    {!! Form::text('domain', isset($domain) ? $domain->domain : null, ['class' => 'form-control', 'placeholder' => 'Digite o dominio', 'required', 'disabled' =>  isset($domain)? true : false]) !!}
</div>
