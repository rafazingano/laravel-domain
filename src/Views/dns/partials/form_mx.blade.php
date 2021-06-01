<div class="row">
    <div class="col-2">
    <h2>Create MX Record</h2>
    </div>
</div>

<div class="row">
    <div class="col-2">
        <div class="form-group">
            <label class="control-label">mail-server <span class="required"> * </span></label>
            {!! Form::text('options["mail_server"]',null, ['class' => 'form-control', 'placeholder' => 'Nome', 'required']) !!}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="control-label">preference <span class="required"> * </span></label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'required']) !!}
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label class="control-label">TTl <span class="required"> * </span></label>
            {!! Form::select('ttl', ['auto' => 'Auto'], null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-5">
        <div class="form-group">
            <label class="control-label">subdomain <span class="required"> * </span></label>
            {!! Form::text('content', null, ['class' => 'form-control', 'placeholder' => 'Conteudo', 'required']) !!}
        </div>
    </div>
</div>




