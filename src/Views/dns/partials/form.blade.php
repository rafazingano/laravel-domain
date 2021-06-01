{!! Form::hidden('domain_id', $domain->id) !!}

@include('domain::dns.partials.form_mx')
<hr>

@include('domain::dns.partials.form_a_aaaa')
<hr>