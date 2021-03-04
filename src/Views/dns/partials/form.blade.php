{!! Form::hidden('domain_id', $domain->id) !!}
<div class="row">
    <div class="col-2">
        <div class="form-group">
            <label class="control-label">Tipo <span class="required"> * </span></label>
            {!! Form::select('type', ['A' => 'A', 'AAAA'=> 'AAAA', 'MX' => 'MX'], isset($dns) ? $dns->type : null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="control-label">Nome <span class="required"> * </span></label>
            {!! Form::text('name', isset($dns) ? $dns->name : null, ['class' => 'form-control', 'placeholder' => 'Nome', 'required']) !!}
        </div>
    </div>
    <div class="col-5">
        <div class="form-group">
            <label class="control-label">Conteudo <span class="required"> * </span></label>
            {!! Form::text('content', isset($dns) ? $dns->content : null, ['class' => 'form-control', 'placeholder' => 'Conteudo', 'required']) !!}
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label class="control-label">TTl <span class="required"> * </span></label>
            {!! Form::select('ttl', ['auto' => 'Auto'], isset($dns) ? $dns->ttl : null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>




