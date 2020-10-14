<table class="table align-items-center table-flush table-striped table-hover" id="domains-table">
    <thead class="thead-light">
        <tr>
            <th>Dominio</th>
            <th>#</th>
        </tr>
    </thead>
</table>

@push('scripts')
    <script>
        $(document).ready(function($) {
            $('#domains-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dashboard.domains.datatables') }}',
                keys: !0,
                select: {
                    style: "multi"
                },
                lengthChange: !1,
                dom: "Bfrtip",
                buttons: ["copy", "print"],
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                },
                columns: [{
                        data: 'domain',
                        name: 'domain'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $("div.dataTables_length select").removeClass("custom-select custom-select-sm");
            $(".dt-buttons .btn").removeClass("btn-secondary").addClass("btn-sm btn-default");
        });
    </script>
@endpush
